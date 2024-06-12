import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/inertia-react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/inertia-react';

const Create = () => {
    const { auth, errors } = usePage().props;
    const [rating, setRating] = useState({
        rating_name: '',
        description: ''
    });

    const handleChange = (e) => {
        const { name, value } = e.target;
        setRating({ ...rating, [name]: value });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        Inertia.post('/rating-masters', rating);
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">評価マスター登録</h2>}
        >
            <Head title="評価マスター登録" />
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <form onSubmit={handleSubmit} className="space-y-4">
                    <div>
                        <label htmlFor="rating_name" className="block text-sm font-medium text-gray-700">評価名</label>
                        <input
                            id="rating_name"
                            name="rating_name"
                            type="text"
                            value={rating.rating_name}
                            onChange={handleChange}
                            className="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        />
                        {errors.rating_name && <span className="text-red-500 text-sm">{errors.rating_name}</span>}
                    </div>
                    <div>
                        <label htmlFor="description" className="block text-sm font-medium text-gray-700">説明</label>
                        <textarea
                            id="description"
                            name="description"
                            value={rating.description}
                            onChange={handleChange}
                            className="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        />
                        {errors.description && <span className="text-red-500 text-sm">{errors.description}</span>}
                    </div>
                    <div className="flex space-x-4">
                        <button
                            type="submit"
                            className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                            保存
                        </button>
                    </div>
                </form>
            </div>
        </AuthenticatedLayout>
    );
};

export default Create;
