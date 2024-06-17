import React from 'react';
import { InertiaLink } from '@inertiajs/inertia-react';

const UserRelatedInfo = ({ userId }) => (
    <div className="shadow overflow-hidden sm:rounded-lg mt-6">
        <div className="px-4 py-5 sm:px-6">
            <h3 className="text-lg leading-6 font-medium text-gray-900">
                ユーザー関連情報
            </h3>
        </div>
        <div className="border-t border-gray-200">
            <dl>
                <div className="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt className="text-sm font-medium text-gray-500">
                        操作
                    </dt>
                    <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <InertiaLink
                            href={`/users/${userId}/ratings`}
                            className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                        >
                            評価一覧
                        </InertiaLink>
                    </dd>
                </div>
            </dl>
        </div>
    </div>
);

export default UserRelatedInfo;
