import React from 'react';
import { TextInput, SelectInput } from '@/Components/FormInputs';

const Form = ({ template, setTemplate, errors, handleSubmit, questionTypes = [] }) => {
    const handleInputChange = (index, field, value) => {
        const newTemplateItems = [...template.template_items];
        newTemplateItems[index][field] = value;
        setTemplate({ ...template, template_items: newTemplateItems });
    };

    const addItem = () => {
        if (template.template_items.length < 10) {
            setTemplate({ ...template, template_items: [...template.template_items, { question_text: '', question_type: '' }] });
        }
    };

    const handleChange = (e) => {
        const { name, value } = e.target;
        setTemplate({ ...template, [name]: value });
    };

    const handleFormSubmit = (e) => {
        e.preventDefault();
        const filteredTemplateItems = template.template_items.filter(item => item.question_text.trim() !== '');
        handleSubmit({ ...template, template_items: filteredTemplateItems });
    };

    return (
        <form onSubmit={handleFormSubmit} className="space-y-4">
            <TextInput
                id="template_name"
                name="template_name"
                label="テンプレート名"
                type="text"
                value={template.template_name}
                onChange={handleChange}
            />
            {errors.template_name && <span className="text-red-500 text-sm">{errors.template_name}</span>}

            {template.template_items.map((item, index) => (
                <div key={index} className="space-y-2">
                    <TextInput
                        id={`question_text_${index}`}
                        name={`question_text_${index}`}
                        label={`質問本文 ${index + 1}`}
                        type="text"
                        value={item.question_text}
                        onChange={(e) => handleInputChange(index, 'question_text', e.target.value)}
                    />
                    {errors[`template_items.${index}.question_text`] && (
                        <span className="text-red-500 text-sm">{errors[`template_items.${index}.question_text`]}</span>
                    )}
                    <SelectInput
                        id={`question_type_${index}`}
                        name={`question_type_${index}`}
                        label={`質問の種類 ${index + 1}`}
                        value={item.question_type}
                        options={questionTypes.map(type => ({ id: type.value, name: type.label }))}
                        onChange={(e) => handleInputChange(index, 'question_type', e.target.value)}
                    />
                    {errors[`template_items.${index}.question_type`] && (
                        <span className="text-red-500 text-sm">{errors[`template_items.${index}.question_type`]}</span>
                    )}
                </div>
            ))}

            <div className="flex space-x-4">
                <button
                    type="button"
                    onClick={addItem}
                    className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                >
                    質問追加
                </button>
                <button
                    type="submit"
                    className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    保存
                </button>
            </div>
        </form>
    );
};

export default Form;
