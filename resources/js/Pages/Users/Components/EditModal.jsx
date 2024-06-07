import React from 'react';
import Modal from '@/Components/Modal';
import { SelectInput } from '@/Components/FormInputs';

const EditModal = ({ isOpen, onClose, title, options, selectedValue, onChange, onSave }) => (
    <Modal show={isOpen} onClose={onClose}>
        <div className="px-6 py-6">
            <h2 className="text-lg font-medium text-gray-900">{title}</h2>
            <div className="mt-4">
                <SelectInput
                    id={`${title}-select`}
                    name={title}
                    label={`${title}を選択`}
                    value={selectedValue}
                    options={options}
                    onChange={(e) => onChange(e.target.value)}
                />
                <button
                    onClick={onSave}
                    className="mt-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    保存
                </button>
            </div>
        </div>
    </Modal>
);

export default EditModal;
