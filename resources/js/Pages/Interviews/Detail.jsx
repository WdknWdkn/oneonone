import React from 'react';
import { usePage } from '@inertiajs/inertia-react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/inertia-react';

const Detail = () => {
    const { auth, interview } = usePage().props;

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">面談詳細</h2>}
        >
            <Head title="面談詳細" />

            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div className="p-6 bg-white border-b border-gray-200">
                        <h3 className="text-lg font-semibold">面談ID: {interview.id}</h3>
                        <div className="mt-4">
                            <p><strong>面談日時:</strong> {interview.interview_date}</p>
                        </div>
                        <div className="mt-4">
                            <p><strong>面談者:</strong> {interview.interviewer.name}</p>
                        </div>
                        <div className="mt-4">
                            <p><strong>被面談者:</strong> {interview.interviewee.name}</p>
                        </div>
                        <div className="mt-4">
                            <p><strong>内容:</strong> {interview.interview_content}</p>
                        </div>
                        <div className="mt-4">
                            <p><strong>メモ:</strong> {interview.notes}</p>
                        </div>
                        <div className="mt-6 flex space-x-4">
                            <a
                                href={`/interviews/${interview.id}/edit`}
                                className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                            >
                                編集
                            </a>
                            <form action={`/interviews/${interview.id}`} method="POST" className="inline">
                                <input type="hidden" name="_method" value="DELETE" />
                                <button
                                    type="submit"
                                    className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                                    onClick={(e) => {
                                        if (!confirm('本当に削除しますか？')) {
                                            e.preventDefault();
                                        }
                                    }}
                                >
                                    削除
                                </button>
                            </form>
                            <a
                                href="/interviews"
                                className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                            >
                                一覧に戻る
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
};

export default Detail;
