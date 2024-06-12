import React, { useState, useEffect, useCallback } from 'react';
import { usePage } from '@inertiajs/inertia-react';
import { Head } from '@inertiajs/inertia-react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Inertia } from '@inertiajs/inertia';
import UserInfo from './Components/UserInfo';
import Interviews from './Components/Interviews';
import EditModal from './Components/EditModal';
import UserRelatedInfo from './Components/UserRelatedInfo';
import { fetchDepartments, fetchPositions, fetchInterviews } from '@/Api/api';

const UserDetail = () => {
    const { auth, user } = usePage().props;
    const [interviews, setInterviews] = useState([]);
    const [loading, setLoading] = useState(true);
    const [isDepartmentModalOpen, setIsDepartmentModalOpen] = useState(false);
    const [isPositionModalOpen, setIsPositionModalOpen] = useState(false);
    const [departments, setDepartments] = useState([]);
    const [positions, setPositions] = useState([]);
    const [selectedDepartment, setSelectedDepartment] = useState(null);
    const [selectedPosition, setSelectedPosition] = useState(null);

    const loadInterviews = useCallback(async () => {
        const data = await fetchInterviews(user.id);
        setInterviews(data.interviews);
        setLoading(false);
    }, [user.id]);

    const loadDepartments = useCallback(async () => {
        const data = await fetchDepartments();
        setDepartments(data.departments);
    }, []);

    const loadPositions = useCallback(async () => {
        const data = await fetchPositions();
        setPositions(data.positions);
    }, []);

    useEffect(() => {
        loadInterviews();
        loadDepartments();
        loadPositions();
    }, [loadInterviews, loadDepartments, loadPositions]);

    const handleSave = async (url, data, onSuccess) => {
        try {
            await Inertia.put(url, data, { preserveState: true, onSuccess });
        } catch (error) {
            console.error(`Error updating ${data}:`, error);
        }
    };

    const handleDepartmentSave = () => handleSave(
        `/users/${user.id}/update-department`,
        { department_id: selectedDepartment },
        () => setIsDepartmentModalOpen(false)
    );

    const handlePositionSave = () => handleSave(
        `/users/${user.id}/update-position`,
        { position_id: selectedPosition },
        () => setIsPositionModalOpen(false)
    );

    return (
        <AuthenticatedLayout user={auth.user} header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">ユーザー詳細</h2>}>
            <Head title="ユーザー詳細" />
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <UserInfo user={user} onDepartmentEdit={() => setIsDepartmentModalOpen(true)} onPositionEdit={() => setIsPositionModalOpen(true)} />
                <UserRelatedInfo userId={user.id} />
                <Interviews loading={loading} interviews={interviews} />
            </div>
            <EditModal
                isOpen={isDepartmentModalOpen}
                onClose={() => setIsDepartmentModalOpen(false)}
                title="部署"
                options={departments}
                selectedValue={selectedDepartment}
                onChange={setSelectedDepartment}
                onSave={handleDepartmentSave}
            />
            <EditModal
                isOpen={isPositionModalOpen}
                onClose={() => setIsPositionModalOpen(false)}
                title="役職"
                options={positions}
                selectedValue={selectedPosition}
                onChange={setSelectedPosition}
                onSave={handlePositionSave}
            />
        </AuthenticatedLayout>
    );
};

export default UserDetail;
