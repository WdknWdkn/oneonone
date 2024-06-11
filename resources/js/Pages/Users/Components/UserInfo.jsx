import React from 'react';

const UserInfo = ({ user, onDepartmentEdit, onPositionEdit }) => (
    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div className="p-6 bg-white border-b border-gray-200">
            <strong>ユーザー情報：</strong>
            <div className="py-4">
                <table className="min-w-full bg-white border">
                    <tbody>
                        {[
                            { label: 'ユーザーID', value: user.id },
                            { label: '名前', value: user.name },
                            { label: '役職', value: user.position?.name },
                            { label: '部署', value: user.department?.name },
                        ].map((item, index) => (
                            <tr key={index} className="border-b">
                                <td className="py-2 px-4 border-b">{item.label}</td>
                                <td className="py-2 px-4 border-b">{item.value}</td>
                            </tr>
                        ))}
                    </tbody>
                </table>
                <div className="mt-4">
                    <button
                        onClick={onDepartmentEdit}
                        className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mr-2"
                    >
                        部署登録
                    </button>
                    <button
                        onClick={onPositionEdit}
                        className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        役職登録
                    </button>
                </div>
            </div>
        </div>
    </div>
);

export default UserInfo;
