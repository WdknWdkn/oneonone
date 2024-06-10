import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/inertia-react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/inertia-react';

const Edit = ({ account: initialAccount }) => {
    const { auth, errors } = usePage().props;
    const [account, setAccount] = useState(initialAccount);

    const handleChange = (e) => {
        const { name, value } = e.target;
        setAccount({ ...account, [name]: value });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        Inertia.put(`/accounts/${account.id}`, account);
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">法人編集</h2>}
        >
            <Head title="法人編集" />
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <form onSubmit={handleSubmit} className="space-y-4">
                    <div>
                        <label htmlFor="name" className="block text-sm font-medium text-gray-700">法人名</label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            value={account.name}
                            onChange={handleChange}
                            className="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        />
                        {errors.name && <span className="text-red-500 text-sm">{errors.name}</span>}
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

export default Edit;
