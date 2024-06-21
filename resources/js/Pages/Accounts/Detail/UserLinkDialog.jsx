import React, { useState } from 'react';
import { Dialog } from '@headlessui/react';

const UserLinkDialog = ({ isOpen, onClose, users, onLink }) => {
    const [selectedUser, setSelectedUser] = useState('');

    const handleLinkClick = () => {
        if (selectedUser) {
            onLink(selectedUser);
        }
    };

    return (
        <Dialog open={isOpen} onClose={onClose} className="fixed z-10 inset-0 overflow-y-auto">
            <div className="flex items-center justify-center min-h-screen">
                <Dialog.Overlay className="fixed inset-0 bg-black opacity-30" />
                <div className="bg-white rounded-lg max-w-md mx-auto p-6 shadow-lg z-20">
                    <Dialog.Title className="text-lg font-medium text-gray-900">ユーザーを紐付ける</Dialog.Title>
                    <div className="mt-4">
                        <select
                            value={selectedUser}
                            onChange={(e) => setSelectedUser(e.target.value)}
                            className="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        >
                            <option value="">ユーザーを選択してください</option>
                            {users.map(user => (
                                <option key={user.id} value={user.id}>
                                    {user.name} ({user.email})
                                </option>
                            ))}
                        </select>
                    </div>
                    <div className="mt-4">
                        <button
                            onClick={handleLinkClick}
                            className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                        >
                            アカウント紐付け
                        </button>
                    </div>
                </div>
            </div>
        </Dialog>
    );
};

export default UserLinkDialog;
