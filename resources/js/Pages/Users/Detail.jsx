import React from 'react';
import { usePage, InertiaLink } from '@inertiajs/inertia-react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/inertia-react';

const UserDetail = () => {
    const { auth, user } = usePage().props;

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">ユーザー詳細</h2>}
        >
            <Head title="ユーザー詳細" />

            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div className="p-6 bg-white border-b border-gray-200">
                        <strong>ユーザー情報：</strong>
                        <table className="min-w-full bg-white border">
                            <tbody>
                                <tr className="border-b">
                                    <td className="py-2 px-4 border-b">ユーザーID</td>
                                    <td className="py-2 px-4 border-b">{user.id}</td>
                                </tr>
                                <tr className="border-b">
                                    <td className="py-2 px-4 border-b">名前</td>
                                    <td className="py-2 px-4 border-b">{user.name}</td>
                                </tr>
                                <tr className="border-b">
                                    <td className="py-2 px-4 border-b">メール</td>
                                    <td className="py-2 px-4 border-b">{user.email}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
};

export default UserDetail;
