import React, { useState, useEffect } from 'react';
import { usePage, InertiaLink } from '@inertiajs/inertia-react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/inertia-react';
import axios from 'axios';
import AnsweredQuestions from './Components/AnsweredQuestions';
import AnswerDialog from './Components/AnswerDialog';

const Detail = () => {
    const { auth, interview, templates = [] } = usePage().props;
    const [isDialogOpen, setIsDialogOpen] = useState(false);
    const [selectedTemplateId, setSelectedTemplateId] = useState('');
    const [answers, setAnswers] = useState([]);

    useEffect(() => {
        if (!selectedTemplateId) return;

        const template = templates.find(t => t.id == selectedTemplateId);

        if (!template) return;

        const newAnswers = template.template_items.map(item => {
            const existingAnswer = interview.interview_answers?.find(a => a.template_item_id === item.id);
            return {
                question_id: item.id,
                question: item.question_text,
                answer: existingAnswer ? existingAnswer.answer_text : '',
                type: item.question_type
            };
        });

        setAnswers(newAnswers);
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
            const response = await axios.post(`/api/interviews/${interview.id}/answers`, { answers, selectedTemplateId });
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
                
                <div className="shadow overflow-hidden sm:rounded-lg">
                    <div className="px-4 py-5 sm:px-6">
                        <h3 className="text-lg leading-6 font-medium text-gray-900">
                            面談情報
                        </h3>
                    </div>
                    <div className="border-t border-gray-200">
                        <dl>
                            <div className="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt className="text-sm font-medium text-gray-500">
                                    面談ID
                                </dt>
                                <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {interview.id}
                                </dd>
                            </div>
                            <div className="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt className="text-sm font-medium text-gray-500">
                                    面談日時
                                </dt>
                                <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {interview.interview_date}
                                </dd>
                            </div>
                            <div className="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt className="text-sm font-medium text-gray-500">
                                    面談者
                                </dt>
                                <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {interview.interviewer?.name}
                                </dd>
                            </div>
                            <div className="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt className="text-sm font-medium text-gray-500">
                                    被面談者
                                </dt>
                                <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {interview.interviewee?.name}
                                </dd>
                            </div>
                            <div className="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt className="text-sm font-medium text-gray-500">
                                    内容
                                </dt>
                                <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {interview.interview_content}
                                </dd>
                            </div>
                            <div className="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt className="text-sm font-medium text-gray-500">
                                    メモ
                                </dt>
                                <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {interview.notes}
                                </dd>
                            </div>
                            <div className="bg-white px-4 py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6">
                                <dt className="text-sm font-medium text-gray-500">
                                    操作
                                </dt>
                                <dd className="mt-1 text-sm text-gray-900 sm:mt-0">
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
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <AnsweredQuestions answers={interview.interview_answers} />
            </div>

            <AnswerDialog
                isDialogOpen={isDialogOpen}
                handleDialogClose={handleDialogClose}
                handleSubmit={handleSubmit}
                templates={templates}
                selectedTemplateId={selectedTemplateId}
                handleTemplateChange={handleTemplateChange}
                answers={answers}
                handleAnswerChange={handleAnswerChange}
            />
        </AuthenticatedLayout>
    );
};

export default Detail;
