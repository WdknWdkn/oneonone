// resources/js/Pages/Accounts/Detail.jsx
import React from 'react';
import { usePage } from '@inertiajs/inertia-react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/inertia-react';
import AccountInfo from './Detail/AccountInfo';
import UserList from './Detail/UserList';

const Detail = ({ account, users }) => {
    const { auth } = usePage().props;

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">アカウント詳細</h2>}
        >
            <Head title="アカウント詳細" />

            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div className="py-6">
                    <AccountInfo account={account} />
                </div>

                <div className="py-6">
                    <UserList account={account} users={users} />
                </div>
            </div>
        </AuthenticatedLayout>
    );
};

export default Detail;
