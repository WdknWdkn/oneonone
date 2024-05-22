import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/inertia-react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/inertia-react';
import Form from './Components/Form';

const InterviewEdit = ({ interview: initialInterview }) => {
    const { auth, users, errors } = usePage().props;
    const [interview, setInterview] = useState(initialInterview);

    const handleInputChange = (updatedInterview) => {
        setInterview(updatedInterview);
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        Inertia.put(`/interviews/${interview.id}`, interview);
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">面談の編集</h2>}
        >
            <Head title="面談の編集" />
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <form onSubmit={handleSubmit} className="space-y-4">
                    <Form users={users} interview={interview} handleInputChange={handleInputChange} errors={errors} />
                    <button type="submit" className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">更新</button>
                </form>
            </div>
        </AuthenticatedLayout>
    );
};

export default InterviewEdit;