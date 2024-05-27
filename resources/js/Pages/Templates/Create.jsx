import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/inertia-react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/inertia-react';
import Form from './Components/Form';

const Create = () => {
    const { auth, errors } = usePage().props;
    const [template, setTemplate] = useState({
        template_name: '',
        template_items: [{ question_text: '', question_type: '' }]
    });

    const handleSubmit = (filteredTemplate) => {
        Inertia.post('/templates', filteredTemplate);
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">質問テンプレート登録</h2>}
        >
            <Head title="質問テンプレート登録" />
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <Form template={template} setTemplate={setTemplate} errors={errors} handleSubmit={handleSubmit} />
            </div>
        </AuthenticatedLayout>
    );
};

export default Create;
