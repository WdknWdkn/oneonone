import React from 'react';
import { InertiaLink } from '@inertiajs/inertia-react';
import AnsweredQuestions from './AnsweredQuestions';

const Interviews = ({ loading, interviews }) => (
    <div className="shadow overflow-hidden sm:rounded-lg mt-6">
        <div className="px-4 py-5 sm:px-6">
            <h3 className="text-lg leading-6 font-medium text-gray-900">
                面談情報
            </h3>
        </div>
        <div className="border-t border-gray-200">
            <dl>
                {loading ? (
                    <div className="bg-gray-50 px-4 py-5 sm:px-6">
                        <dt className="text-sm font-medium text-gray-500">
                            読み込み中...
                        </dt>
                    </div>
                ) : (
                    <div className="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6">
                        <div className="overflow-x-auto py-4">
                            <div className="inline-block min-w-full align-middle">
                                <div className="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table className="min-w-full divide-y divide-gray-200">
                                        <thead className="bg-slate-300">
                                            <tr>
                                                {['ID', '面談日時', '被面談者', '面談内容', 'メモ', '操作'].map((header, index) => (
                                                    <th
                                                        key={index}
                                                        scope="col"
                                                        className="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                                                    >
                                                        {header}
                                                    </th>
                                                ))}
                                            </tr>
                                        </thead>
                                        <tbody className="bg-white divide-y divide-gray-200">
                                            {interviews.map(interview => (
                                                <React.Fragment key={interview.id}>
                                                    <tr className="bg-slate-100">
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
                                                        <td colSpan="6" className="px-0 py-0 whitespace-nowrap text-sm text-gray-500">
                                                            <AnsweredQuestions answers={interview.interview_answers || []} key={`answers-${interview.id}`} />
                                                        </td>
                                                    </tr>
                                                </React.Fragment>
                                            ))}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                )}
            </dl>
        </div>
    </div>
);

export default Interviews;
