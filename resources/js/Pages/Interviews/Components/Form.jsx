import React from 'react';

const Form = ({ users, interview, handleInputChange, errors }) => {
    return (
        <>
            <div className="py-2">
                <label htmlFor="interview_date" className="block text-lg font-medium text-gray-700">面談日</label>
                <input
                    type="date"
                    id="interview_date"
                    name="interview_date"
                    value={interview.interview_date}
                    onChange={handleInputChange}
                    required
                    className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                />
                {errors.interview_date && <span className="text-red-500 text-sm">{errors.interview_date}</span>}
            </div>

            <div className="py-2">
                <label htmlFor="interviewer_name" className="block text-lg font-medium text-gray-700">面談者名</label>
                <input
                    type="text"
                    id="interviewer_name"
                    name="interviewer_name"
                    value={interview.interviewer_name}
                    onChange={handleInputChange}
                    required
                    className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                />
                {errors.interviewer_name && <span className="text-red-500 text-sm">{errors.interviewer_name}</span>}
            </div>

            <div className="py-2">
                <label htmlFor="interviewer_id" className="block text-lg font-medium text-gray-700">面談者ID</label>
                <select
                    id="interviewer_id"
                    name="interviewer_id"
                    value={interview.interviewer_id}
                    onChange={handleInputChange}
                    required
                    className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                >
                    <option value="">選択してください</option>
                    {users.map(user => (
                        <option key={user.id} value={user.id}>
                            {user.name}
                        </option>
                    ))}
                </select>
                {errors.interviewer_id && <span className="text-red-500 text-sm">{errors.interviewer_id}</span>}
            </div>

            <div className="py-2">
                <label htmlFor="interviewee_name" className="block text-lg font-medium text-gray-700">被面談者名</label>
                <input
                    type="text"
                    id="interviewee_name"
                    name="interviewee_name"
                    value={interview.interviewee_name}
                    onChange={handleInputChange}
                    required
                    className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                />
                {errors.interviewee_name && <span className="text-red-500 text-sm">{errors.interviewee_name}</span>}
            </div>

            <div className="py-2">
                <label htmlFor="interviewee_id" className="block text-lg font-medium text-gray-700">被面談者名ID</label>
                <select
                    id="interviewee_id"
                    name="interviewee_id"
                    value={interview.interviewee_id}
                    onChange={handleInputChange}
                    required
                    className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                >
                    <option value="">選択してください</option>
                    {users.map(user => (
                        <option key={user.id} value={user.id}>
                            {user.name}
                        </option>
                    ))}
                </select>
                {errors.interviewee_id && <span className="text-red-500 text-sm">{errors.interviewee_id}</span>}
            </div>

            <div className="py-2">
                <label htmlFor="interview_content" className="block text-lg font-medium text-gray-700">面談内容</label>
                <textarea
                    id="interview_content"
                    name="interview_content"
                    value={interview.interview_content}
                    onChange={handleInputChange}
                    required
                    className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                />
                {errors.interview_content && <span className="text-red-500 text-sm">{errors.interview_content}</span>}
            </div>

            <div className="py-2">
                <label htmlFor="notes" className="block text-lg font-medium text-gray-700">備考</label>
                <textarea
                    id="notes"
                    name="notes"
                    value={interview.notes}
                    onChange={handleInputChange}
                    className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                />
                {errors.notes && <span className="text-red-500 text-sm">{errors.notes}</span>}
            </div>
        </>
    );
};

export default Form;
