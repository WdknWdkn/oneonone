import React, { useState, useEffect } from 'react';
import { usePage } from '@inertiajs/inertia-react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/inertia-react';
import { SelectInput, TextInput } from '@/Components/FormInputs';
import { Inertia } from '@inertiajs/inertia';

const Index = () => {
    const { auth, users: initialUsers } = usePage().props;
    const [searchFormVisible, setSearchFormVisible] = useState(false);
    const [interviewerId, setInterviewerId] = useState('');
    const [intervieweeId, setIntervieweeId] = useState('');
    const [dateFrom, setDateFrom] = useState('');
    const [dateTo, setDateTo] = useState('');
    const [interviews, setInterviews] = useState([]);

    const handleError = (error, defaultMessage) => {
        console.error(defaultMessage, error);
        alert(defaultMessage);
    };

    const fetchInterviews = async (params = {}) => {
        try {
            const query = new URLSearchParams(params).toString();
            const response = await fetch(`/api/interviews?${query}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
            });
    
            if (!response.ok) {
                throw new Error(`Failed to fetch interviews: ${response.statusText}`);
            }
    
            const data = await response.json();
            setInterviews(data.interviews || []);
        } catch (error) {
            handleError(error, 'Fetch interviews failed');
            setInterviews([]);
        }
    };

    useEffect(() => {
        fetchInterviews();  // 画面がロードされた際に面談一覧を取得
    }, []);

    const toggleForm = () => {
        setSearchFormVisible(!searchFormVisible);
    };

    const buildSearchParams = () => ({
        interviewer_id: interviewerId,
        interviewee_id: intervieweeId,
        date_from: dateFrom,
        date_to: dateTo,
    });
    
    const handleSearch = async (e) => {
        e.preventDefault();
        try {
            const params = buildSearchParams();
            await fetchInterviews(params);
        } catch (error) {
            handleError(error, 'Search interviews failed');
        }
    };

    const handleDelete = async (id, e) => {
        e.preventDefault();
        if (confirm('本当に削除しますか？')) {
            try {
                const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
                const response = await fetch(`/api/interviews/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                });

                if (!response.ok) {
                    throw new Error(`Failed to delete interview: ${response.statusText}`);
                }

                const data = await response.json();
                if (data.success) {
                    setInterviews(interviews.filter(interview => interview.id !== id));
                } else {
                    throw new Error('Delete interview failed');
                }
            } catch (error) {
                handleError(error, 'Delete interview failed');
            }
        }
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">面談一覧</h2>}
        >
            <Head title="面談一覧" />

            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <button
                    onClick={toggleForm}
                    className="mt-4 mb-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                >
                    検索を開く
                </button>

                {searchFormVisible && (
                    <div id="searchForm" className="bg-white p-4 shadow rounded-md">
                        <form onSubmit={handleSearch}>
                            <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4">
                                <SelectInput
                                    id="interviewer_id"
                                    name="interviewer_id"
                                    label="面談者ID"
                                    value={interviewerId}
                                    options={initialUsers.map(user => ({ id: user.id, name: user.name }))}
                                    onChange={(e) => setInterviewerId(e.target.value)}
                                />
                                <SelectInput
                                    id="interviewee_id"
                                    name="interviewee_id"
                                    label="被面談者ID"
                                    value={intervieweeId}
                                    options={initialUsers.map(user => ({ id: user.id, name: user.name }))}
                                    onChange={(e) => setIntervieweeId(e.target.value)}
                                />
                                <TextInput
                                    id="date_from"
                                    name="date_from"
                                    label="面談日From"
                                    type="date"
                                    value={dateFrom}
                                    onChange={(e) => setDateFrom(e.target.value)}
                                />
                                <TextInput
                                    id="date_to"
                                    name="date_to"
                                    label="面談日To"
                                    type="date"
                                    value={dateTo}
                                    onChange={(e) => setDateTo(e.target.value)}
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
                    <div className="py-4">
                        <a
                            href="/interviews/create"
                            className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                        >
                            新規登録
                        </a>
                    </div>
                    <div className="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table className="min-w-full divide-y divide-gray-200">
                            <thead className="bg-gray-50">
                                <tr>
                                    <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">面談日時</th>
                                    <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">面談者</th>
                                    <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">被面談者</th>
                                    <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">操作</th>
                                </tr>
                            </thead>
                            <tbody className="bg-white divide-y divide-gray-200">
                                {interviews.map(interview => (
                                    <tr key={interview.id}>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{interview.id}</td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{interview.interview_date}</td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{interview.interviewer_name}</td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{interview.interviewee_name}</td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button
                                                onClick={() => window.location.href=`/interviews/${interview.id}/`}
                                                className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mr-2"
                                            >
                                                詳細
                                            </button>
                                            <button
                                                onClick={() => window.location.href=`/interviews/${interview.id}/edit`}
                                                className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mr-2"
                                            >
                                                編集
                                            </button>
                                            <form action={`/interviews/${interview.id}`} method="POST" className="inline">
                                                <input type="hidden" name="_method" value="DELETE" />
                                                <button
                                                    className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                                                    onClick={(e) => handleDelete(interview.id, e)}
                                                >
                                                    削除
                                                </button>
                                            </form>
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

export default Index;
