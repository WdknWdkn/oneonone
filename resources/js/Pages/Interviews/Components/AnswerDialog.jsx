import React from 'react';
import { SelectInput, TextInput } from '@/Components/FormInputs';

const AnswerDialog = ({
    isDialogOpen,
    handleDialogClose,
    handleSubmit,
    templates,
    selectedTemplateId,
    handleTemplateChange,
    answers,
    handleAnswerChange,
}) => {
    return (
        isDialogOpen && (
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
        )
    );
};

export default AnswerDialog;
