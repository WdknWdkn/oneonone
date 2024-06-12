import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';
import { usePage, InertiaLink } from '@inertiajs/inertia-react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/inertia-react';
import { SelectInput, TextInput, TextAreaInput } from '@/Components/FormInputs';

const Edit = ({ user, userRating, ratingMasters }) => {
    const { auth, errors } = usePage().props;
    const [rating, setRating] = useState(userRating);

    const handleChange = (e) => {
        const { name, value } = e.target;
        setRating({ ...rating, [name]: value });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        Inertia.put(`/users/${user.id}/ratings/${rating.id}`, rating);
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">{user.name}の評価編集</h2>}
        >
            <Head title="評価編集" />
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <form onSubmit={handleSubmit} className="space-y-4">
                    <SelectInput
                        id="rating_master_id"
                        name="rating_master_id"
                        label="評価名"
                        value={rating.rating_master_id}
                        options={ratingMasters.map((master) => ({ id: master.id, name: master.rating_name }))}
                        onChange={handleChange}
                    />
                    {errors.rating_master_id && <span className="text-red-500 text-sm">{errors.rating_master_id}</span>}
                    <TextInput
                        id="rating_date"
                        name="rating_date"
                        label="評価日"
                        type="date"
                        value={rating.rating_date}
                        onChange={handleChange}
                    />
                    {errors.rating_date && <span className="text-red-500 text-sm">{errors.rating_date}</span>}
                    <TextAreaInput
                        id="reason"
                        name="reason"
                        label="評価理由"
                        value={rating.reason}
                        onChange={handleChange}
                    />
                    {errors.reason && <span className="text-red-500 text-sm">{errors.reason}</span>}
                    <div className="flex space-x-4">
                        <button
                            type="submit"
                            className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                            保存
                        </button>
                        <InertiaLink
                            href={`/users/${user.id}/ratings`}
                            className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-500 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                        >
                            キャンセル
                        </InertiaLink>
                    </div>
                </form>
            </div>
        </AuthenticatedLayout>
    );
};

export default Edit;
