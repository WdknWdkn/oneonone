import React from 'react';

const AnsweredQuestions = ({ answers }) => {
    return (
        <div className="mt-4">
            <strong>回答済質問:</strong>
            <table className="min-w-full bg-white border">
                <thead>
                    <tr>
                        <th className="py-2 px-4 border-b">質問</th>
                        <th className="py-2 px-4 border-b">回答</th>
                    </tr>
                </thead>
                <tbody>
                    {answers.map((answer, index) => (
                        <tr key={index} className="border-b">
                            <td className="py-2 px-4 border-b">{answer.templateItem?.question_text}</td>
                            <td className="py-2 px-4 border-b">{answer.answer_text}</td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
};

export default AnsweredQuestions;
