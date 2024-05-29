import React from 'react';
import { SelectInput, TextInput, TextAreaInput } from '@/Components/FormInputs';

const Form = ({ users, interview, handleInputChange, errors }) => {

    const handleChange = (e) => {
        handleInputChange(e);
    };

    return (
        <>
            <TextInput
                id="interview_date"
                name="interview_date"
                label="面談日"
                type="date"
                value={interview.interview_date}
                onChange={handleChange}
            />
            {errors.interview_date && <span className="text-red-500 text-sm">{errors.interview_date}</span>}

            <SelectInput
                id="interviewer_id"
                name="interviewer_id"
                label="面談者ID"
                value={interview.interviewer_id}
                options={users}
                onChange={handleChange}
            />
            {errors.interviewer_id && <span className="text-red-500 text-sm">{errors.interviewer_id}</span>}

            <TextInput
                id="interviewer_name"
                name="interviewer_name"
                label="面談者名"
                type="text"
                value={interview.interviewer_name}
                onChange={handleChange}
            />
            {errors.interviewer_name && <span className="text-red-500 text-sm">{errors.interviewer_name}</span>}

            <SelectInput
                id="interviewee_id"
                name="interviewee_id"
                label="被面談者ID"
                value={interview.interviewee_id}
                options={users}
                onChange={handleChange}
            />
            {errors.interviewee_id && <span className="text-red-500 text-sm">{errors.interviewee_id}</span>}

            <TextInput
                id="interviewee_name"
                name="interviewee_name"
                label="被面談者名"
                type="text"
                value={interview.interviewee_name}
                onChange={handleChange}
            />
            {errors.interviewee_name && <span className="text-red-500 text-sm">{errors.interviewee_name}</span>}

            <TextAreaInput
                id="interview_content"
                name="interview_content"
                label="面談内容"
                value={interview.interview_content}
                onChange={handleChange}
            />
            {errors.interview_content && <span className="text-red-500 text-sm">{errors.interview_content}</span>}

            <TextAreaInput
                id="notes"
                name="notes"
                label="備考"
                value={interview.notes}
                onChange={handleChange}
            />
            {errors.notes && <span className="text-red-500 text-sm">{errors.notes}</span>}
        </>
    );
};

export default Form;
