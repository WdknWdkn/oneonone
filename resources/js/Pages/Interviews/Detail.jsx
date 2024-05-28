import React, { useState, useEffect } from 'react';
import { usePage, InertiaLink } from '@inertiajs/inertia-react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/inertia-react';
import axios from 'axios';
import { SelectInput, TextInput } from '@/Components/FormInputs';

const Detail = () => {
    const { auth, interview, templates = [] } = usePage().props;
    const [isDialogOpen, setIsDialogOpen] = useState(false);
    const [selectedTemplateId, setSelectedTemplateId] = useState('');
    const [answers, setAnswers] = useState([]);

    useEffect(() => {
        if (selectedTemplateId) {
            const template = templates.find(t => t.id == selectedTemplateId);
            if (template) {
                const newAnswers = template.template_items.map(item => {
                    const existingAnswer = interview.answers?.find(a => a.template_item_id === item.id);
                    return {
                        question_id: item.id,
                        question: item.question_text,
                        answer: existingAnswer ? existingAnswer.answer_text : '',
                    };
                });
                setAnswers(newAnswers);
            }
        }
    }, [selectedTemplateId]);

    const handleDialogOpen = () => {
        setIsDialogOpen(true);
    };

    const handleDialogClose = () => {
        setIsDialogOpen(false);
        setSelectedTemplateId('');
        setAnswers([]);
    };

    const handleTemplateChange = (e) => {
        setSelectedTemplateId(e.target.value);
    };

    const handleAnswerChange = (index, value) => {
        const newAnswers = [...answers];
        newAnswers[index].answer = value;
        setAnswers(newAnswers);
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            const response = await axios.post(`/api/interviews/${interview.id}/answers`, { answers });
            if (response.status === 200) {
                handleDialogClose();
                window.location.reload();
            }
        } catch (error) {
            console.error('Error submitting answers:', error);
        }
    };

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
                            <p><strong>面談者:</strong> {interview.interviewer?.name}</p>
                        </div>
                        <div className="mt-4">
                            <p><strong>被面談者:</strong> {interview.interviewee?.name}</p>
                        </div>
                        <div className="mt-4">
                            <p><strong>内容:</strong> {interview.interview_content}</p>
                        </div>
                        <div className="mt-4">
                            <p><strong>メモ:</strong> {interview.notes}</p>
                        </div>
                        <div className="mt-4">
                            <strong>回答済質問:</strong>
                            <ul>
                                {interview.answers?.map((answer, index) => (
                                    <li key={index}>{answer.templateItem?.question_text}: {answer.answer_text}</li>
                                ))}
                            </ul>
                        </div>
                        <div className="mt-6 flex space-x-4">
                            <InertiaLink
                                href={`/interviews/${interview.id}/edit`}
                                className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                            >
                                編集
                            </InertiaLink>
                            <form action={`/interviews/${interview.id}`} method="POST" className="inline">
                                <input type="hidden" name="_method" value="DELETE" />
                                <input type="hidden" name="_token" value={document.querySelector('meta[name="csrf-token"]').content} />
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
                            <InertiaLink
                                href="/interviews"
                                className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                            >
                                一覧に戻る
                            </InertiaLink>
                            <button
                                onClick={handleDialogOpen}
                                className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            >
                                質問に回答する
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {isDialogOpen && (
                <div className="fixed z-10 inset-0 overflow-y-auto">
                    <div className="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div className="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                        <span className="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                        <div className="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                            <div className="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div className="sm:flex sm:items-start">
                                    <div className="mt-3 text-center sm:mt-0 sm:text-left">
                                        <h3 className="text-lg leading-6 font-medium text-gray-900">
                                            質問に回答する
                                        </h3>
                                        <div className="mt-2">
                                            <form onSubmit={handleSubmit}>
                                                <SelectInput
                                                    id="template"
                                                    name="template"
                                                    label="テンプレートを選択"
                                                    value={selectedTemplateId}
                                                    options={templates.map(template => ({
                                                        id: template.id,
                                                        name: template.template_name,
                                                    }))}
                                                    onChange={handleTemplateChange}
                                                />
                                                {answers.map((answer, index) => (
                                                    <TextInput
                                                        key={index}
                                                        id={`question_${index}`}
                                                        name={`question_${index}`}
                                                        label={answer.question}
                                                        type="text"
                                                        value={answer.answer}
                                                        onChange={(e) => handleAnswerChange(index, e.target.value)}
                                                    />
                                                ))}
                                                <div className="mt-5 sm:mt-6 flex space-x-4">
                                                    <button
                                                        type="button"
                                                        className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                                                        onClick={handleDialogClose}
                                                    >
                                                        キャンセル
                                                    </button>
                                                    <button
                                                        type="submit"
                                                        className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                                    >
                                                        送信
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            )}
        </AuthenticatedLayout>
    );
};

export default Detail;
