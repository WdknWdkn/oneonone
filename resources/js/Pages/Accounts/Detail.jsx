import React, { useState } from 'react';
import { usePage } from '@inertiajs/inertia-react'; 
import { Inertia } from '@inertiajs/inertia'; // 正しい方法でインポート
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/inertia-react';
import AccountInfo from './Detail/AccountInfo';
import UserList from './Detail/UserList';
import UserLinkDialog from './Detail/UserLinkDialog';

const Detail = ({ account, users, unlinkedUsers }) => {
    const { auth } = usePage().props;
    const [isDialogOpen, setIsDialogOpen] = useState(false);

    const handleLinkUsers = (userId) => {
        Inertia.post(`/accounts/${account.id}/link-user`, { user_id: userId }, {
            onSuccess: () => setIsDialogOpen(false)
        });
    };

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

                <div className="py-6">
                    <button
                        onClick={() => setIsDialogOpen(true)}
                        className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                    >
                        未登録ユーザー紐付け
                    </button>
                </div>
            </div>

            <UserLinkDialog
                isOpen={isDialogOpen}
                onClose={() => setIsDialogOpen(false)}
                users={unlinkedUsers}
                onLink={handleLinkUsers}
            />
        </AuthenticatedLayout>
    );
};

export default Detail;
