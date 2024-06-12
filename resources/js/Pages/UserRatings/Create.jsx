import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';
import { usePage, InertiaLink } from '@inertiajs/inertia-react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/inertia-react';

const Create = ({ user, ratingMasters }) => {
    const { auth, errors } = usePage().props;
    const [rating, setRating] = useState({
        rating_master_id: '',
        rating_date: '',
    });

    const handleChange = (e) => {
        const { name, value } = e.target;
        setRating({ ...rating, [name]: value });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        Inertia.post(`/users/${user.id}/ratings`, rating);
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">{user.name}の評価登録</h2>}
        >
            <Head title="評価登録" />
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <form onSubmit={handleSubmit} className="space-y-4">
                    <div>
                        <label htmlFor="rating_master_id" className="block text-sm font-medium text-gray-700">評価名</label>
                        <select
                            id="rating_master_id"
                            name="rating_master_id"
                            value={rating.rating_master_id}
                            onChange={handleChange}
                            className="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        >
                            <option value="">選択してください</option>
                            {ratingMasters.map((master) => (
                                <option key={master.id} value={master.id}>
                                    {master.rating_name}
                                </option>
                            ))}
                        </select>
                        {errors.rating_master_id && <span className="text-red-500 text-sm">{errors.rating_master_id}</span>}
                    </div>
                    <div>
                        <label htmlFor="rating_date" className="block text-sm font-medium text-gray-700">評価日</label>
                        <input
                            id="rating_date"
                            name="rating_date"
                            type="date"
                            value={rating.rating_date}
                            onChange={handleChange}
                            className="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        />
                        {errors.rating_date && <span className="text-red-500 text-sm">{errors.rating_date}</span>}
                    </div>
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

export default Create;
