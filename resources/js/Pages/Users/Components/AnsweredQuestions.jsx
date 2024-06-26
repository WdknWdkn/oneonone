import React from 'react';
import { formatDate } from '@/Components/DateUtils';

const AnsweredQuestions = ({ answers }) => {
    if (!answers || answers.length === 0) {
        return <div className="px-6 py-4"><p>質問と回答がありません。</p></div>;
    }

    return (
        <div className="">
            <table className="min-w-full bg-white">
                    {answers.map((answer, index) => (
                        <tbody key={index}>
                            <tr className="border-b text-left">
                                <th className="py-2 px-4 border-b font-semibold">{answer.template_item?.question_text || '不明な質問'}</th>
                                <td className="py-2 px-4 border-b">{answer.answer_text || '未回答'}</td>
                            </tr>
                        </tbody>
                    ))}
            </table>
        </div>
    );
};

export default AnsweredQuestions;
