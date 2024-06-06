import React, { useState, useEffect } from 'react';
import { usePage, InertiaLink } from '@inertiajs/inertia-react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/inertia-react';
import AnsweredQuestions from './Components/AnsweredQuestions';

const UserDetail = () => {
    const { auth, user } = usePage().props;
    const [interviews, setInterviews] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchInterviews = async () => {
            try {
                const response = await fetch(`/api/users/${user.id}/interviews`);
                const data = await response.json();
                setInterviews(data.interviews);
            } catch (error) {
                console.error('Error fetching interviews:', error);
            } finally {
                setLoading(false);
            }
        };

        fetchInterviews();
    }, [user.id]);

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
                            </tbody>
                        </table>
                    </div>
                </div>

                <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                    <div className="p-6 bg-white border-b border-gray-200">
                        <strong>面談情報：</strong>
                        {loading ? (
                            <p>読み込み中...</p>
                        ) : (
                            <div className="overflow-x-auto">
                                <div className="inline-block min-w-full align-middle">
                                    <div className="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <table className="min-w-full divide-y divide-gray-200">
                                            <thead className="bg-slate-300">
                                                <tr>
                                                    <th scope="col" className="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                                                    <th scope="col" className="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">面談日時</th>
                                                    <th scope="col" className="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">被面談者</th>
                                                    <th scope="col" className="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">面談内容</th>
                                                    <th scope="col" className="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">メモ</th>
                                                    <th scope="col" className="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">操作</th>
                                                </tr>
                                            </thead>
                                            <tbody className="bg-white divide-y divide-gray-200">
                                                {interviews.map(interview => (
                                                    <React.Fragment key={interview.id}>
                                                        <tr class="bg-slate-100">
                                                            <td className="px-6 py-3 whitespace-nowrap text-sm font-semibold text-gray-900">{interview.id}</td>
                                                            <td className="px-6 py-3 whitespace-nowrap text-sm font-semibold text-gray-700">{interview.interview_date}</td>
                                                            <td className="px-6 py-3 whitespace-nowrap text-sm font-semibold text-gray-700">{interview.interviewee?.name}</td>
                                                            <td className="px-6 py-3 whitespace-nowrap text-sm font-semibold text-gray-700">{interview.interview_content}</td>
                                                            <td className="px-6 py-3 whitespace-nowrap text-sm font-semibold text-gray-700">{interview.notes}</td>
                                                            <td className="px-6 py-3 whitespace-nowrap text-sm font-semibold">
                                                                <InertiaLink
                                                                    href={`/interviews/${interview.id}`}
                                                                    className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                                                                >
                                                                    詳細
                                                                </InertiaLink>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colSpan="7" className="px-0 py-0 whitespace-nowrap text-sm text-gray-500">
                                                                <AnsweredQuestions answers={interview.interview_answers || []} />
                                                            </td>
                                                        </tr>
                                                    </React.Fragment>
                                                ))}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
};

export default UserDetail;
