import React from 'react';
import { formatDate } from '@/Components/DateUtils';

const AnsweredQuestions = ({ answers }) => {
    return (
        <div className="mt-4">
            <strong>回答済質問：</strong>
            <table className="min-w-full bg-white border">
                <thead>
                    <tr>
                        <th className="py-2 px-4 border-b">質問</th>
                        <th className="py-2 px-4 border-b">回答</th>
                        <th className="py-2 px-4 border-b">回答日時</th>
                    </tr>
                </thead>
                <tbody>
                    {answers.map((answer, index) => (
                        <tr key={index} className="border-b">
                            <td className="py-2 px-4 border-b">{answer.template_item?.question_text}</td>
                            <td className="py-2 px-4 border-b">{answer.answer_text}</td>
                            <td className="py-2 px-4 border-b">
                                {formatDate(answer.created_at)}
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
};

export default AnsweredQuestions;
