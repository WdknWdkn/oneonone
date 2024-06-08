import React, { useState, useEffect, useCallback } from 'react';
import { usePage } from '@inertiajs/inertia-react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, InertiaLink } from '@inertiajs/inertia-react';
import { SelectInput, TextInput } from '@/Components/FormInputs';
import { fetchDepartments, fetchPositions } from '@/Api/api';

const UserIndex = ({ users }) => {
    const { auth, params } = usePage().props;
    const [searchFormVisible, setSearchFormVisible] = useState(false);
    const [name, setName] = useState(params.name || '');
    const [email, setEmail] = useState(params.email || '');
    const [departmentId, setDepartmentId] = useState(params.department_id || '');
    const [positionId, setPositionId] = useState(params.position_id || '');
    const [departments, setDepartments] = useState([]);
    const [positions, setPositions] = useState([]);

    const toggleForm = () => {
        setSearchFormVisible(!searchFormVisible);
    };

    const fetchInitialData = useCallback(async () => {
        const [departmentsData, positionsData] = await Promise.all([
            fetchDepartments(),
            fetchPositions()
        ]);
        setDepartments(departmentsData.departments);
        setPositions(positionsData.positions);
    }, []);

    useEffect(() => {
        fetchInitialData();
    }, [fetchInitialData]);

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">ユーザー一覧</h2>}
        >
            <Head title="ユーザー一覧" />

            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <button
                    onClick={toggleForm}
                    className="mt-4 mb-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                >
                    検索を開く
                </button>

                {searchFormVisible && (
                    <div id="searchForm" className="bg-white p-4 shadow rounded-md">
                        <form method="GET" action="/users">
                            <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4">
                                <TextInput
                                    id="name"
                                    name="name"
                                    label="名前"
                                    type="text"
                                    value={name}
                                    onChange={(e) => setName(e.target.value)}
                                />
                                <TextInput
                                    id="email"
                                    name="email"
                                    label="メール"
                                    type="email"
                                    value={email}
                                    onChange={(e) => setEmail(e.target.value)}
                                />
                                <SelectInput
                                    id="department_id"
                                    name="department_id"
                                    label="部署"
                                    value={departmentId}
                                    options={departments}
                                    onChange={(e) => setDepartmentId(e.target.value)}
                                />
                                <SelectInput
                                    id="position_id"
                                    name="position_id"
                                    label="役職"
                                    value={positionId}
                                    options={positions}
                                    onChange={(e) => setPositionId(e.target.value)}
                                />
                            </div>
                            <div className="mt-4">
                                <button
                                    type="submit"
                                    className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                                >
                                    検索
                                </button>
                            </div>
                        </form>
                    </div>
                )}

                <div className="py-6">
                    <div className="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table className="min-w-full divide-y divide-gray-200">
                            <thead className="bg-gray-50">
                                <tr>
                                    <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">名前</th>
                                    <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">部署</th>
                                    <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">役職</th>
                                    <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">操作</th>
                                </tr>
                            </thead>
                            <tbody className="bg-white divide-y divide-gray-200">
                                {users.map(user => (
                                    <tr key={user.id}>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{user.id}</td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{user.name}</td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{user.department?.name}</td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{user.position?.name}</td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <InertiaLink
                                                href={`/users/${user.id}`}
                                                className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                                            >
                                                詳細
                                            </InertiaLink>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
};

export default UserIndex;
