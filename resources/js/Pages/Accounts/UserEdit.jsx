import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/inertia-react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/inertia-react';
import { TextInput, SelectInput } from '@/Components/FormInputs';

const UsersEdit = ({ user }) => {
    const { auth, roleOptions } = usePage().props;

    const [values, setValues] = useState({
        name: user.name || '',
        email: user.email || '',
        role: user.role || '',
    });

    const handleChange = (e) => {
        const key = e.target.id;
        const value = e.target.value;
        setValues(values => ({
            ...values,
            [key]: value,
        }));
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        Inertia.put(route('account.user.update', { account: user.account_id, user: user.id }), values);
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">ユーザー編集</h2>}
        >
            <Head title="ユーザー編集" />

            <div className="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div className="p-6 bg-white border-b border-gray-200">
                        <form onSubmit={handleSubmit}>
                            <TextInput
                                id="name"
                                name="name"
                                label="名前"
                                type="text"
                                value={values.name}
                                onChange={handleChange}
                            />
                            <TextInput
                                id="email"
                                name="email"
                                label="メールアドレス"
                                type="email"
                                value={values.email}
                                onChange={handleChange}
                            />
                            <SelectInput
                                id="role"
                                name="role"
                                label="権限"
                                value={values.role}
                                options={roleOptions}
                                onChange={handleChange}
                            />
                            <div className="mt-6">
                                <button
                                    type="submit"
                                    className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                    更新
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
};

export default UsersEdit;
