import React from 'react';
import { formatDate } from '@/Components/DateUtils';

const AnsweredQuestions = ({ answers }) => {
    return (
        <div className="shadow overflow-hidden sm:rounded-lg mt-6">
            <div className="px-4 py-5 sm:px-6">
                <h3 className="text-lg leading-6 font-medium text-gray-900">
                    回答済みの質問
                </h3>
            </div>
            <div className="border-t border-gray-200">
                <dl>
                    <div className="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6">
                        <div className="overflow-x-auto py-4">
                            <div className="inline-block min-w-full align-middle">
                                <div className="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table className="min-w-full divide-y divide-gray-200">
                                        <thead className="bg-slate-300">
                                            <tr>
                                                <th className="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                    質問
                                                </th>
                                                <th className="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                    回答
                                                </th>
                                                <th className="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                    回答日時
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody className="bg-white divide-y divide-gray-200">
                                            {answers.map((answer, index) => (
                                                <tr key={index} className="bg-slate-100">
                                                    <td className="px-6 py-3 whitespace-nowrap text-sm font-semibold text-gray-900">
                                                        {answer.template_item?.question_text}
                                                    </td>
                                                    <td className="px-6 py-3 whitespace-nowrap text-sm font-semibold text-gray-700">
                                                        {answer.answer_text}
                                                    </td>
                                                    <td className="px-6 py-3 whitespace-nowrap text-sm font-semibold text-gray-700">
                                                        {formatDate(answer.created_at)}
                                                    </td>
                                                </tr>
                                            ))}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </dl>
            </div>
        </div>
    );
};

export default AnsweredQuestions;
