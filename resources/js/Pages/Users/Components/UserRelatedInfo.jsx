import React from 'react';
import { InertiaLink } from '@inertiajs/inertia-react';

const UserRelatedInfo = ({ userId }) => {
    return (
        <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
            <div className="p-6 bg-white border-b border-gray-200">
                <strong>ユーザー関連情報：</strong>
                <div className="py-4">
                    <InertiaLink
                        href={`/users/${userId}/ratings`}
                        className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                    >
                        評価一覧
                    </InertiaLink>
                </div>
            </div>
        </div>
    );
};

export default UserRelatedInfo;
