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
        console.log('interview.answers:', interview.answers); // ここでanswersの内容を確認
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
                        <AnsweredQuestions answers={interview.answers} />
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
