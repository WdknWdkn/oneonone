import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/inertia-react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/inertia-react';
import Form from './Components/Form';

const InterviewCreate = () => {
    const { auth, users, errors } = usePage().props;
    const [interview, setInterview] = useState({
        interview_date: '',
        interviewer_name: '',
        interviewer_id: '',
        interviewee_name: '',
        interviewee_id: '',
        interview_content: '',
        notes: ''
    });

    const handleInputChange = (e) => {
        const { name, value } = e.target;
        setInterview(prevInterview => ({
            ...prevInterview,
            [name]: value,
            // インタビューワーIDやインタビューイーIDが変更された場合、名前も更新する
            ...(name === 'interviewer_id' && { interviewer_name: users.find(user => user.id == value)?.name || '' }),
            ...(name === 'interviewee_id' && { interviewee_name: users.find(user => user.id == value)?.name || '' }),
        }));
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        Inertia.post('/interviews', interview);
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">新規面談</h2>}
        >
            <Head title="新規面談" />
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <form onSubmit={handleSubmit} className="space-y-4">
                    <Form users={users} interview={interview} handleInputChange={handleInputChange} errors={errors} />
                    <button type="submit" className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">登録</button>
                </form>
            </div>
        </AuthenticatedLayout>
    );
};

export default InterviewCreate;
