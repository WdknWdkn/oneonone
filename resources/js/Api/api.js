// src/api/api.js

export const fetchInterviews = async (userId) => {
    try {
        const response = await fetch(`/api/users/${userId}/interviews`);
        return await response.json();
    } catch (error) {
        console.error('Error fetching interviews:', error);
        return { interviews: [] };
    }
};

export const fetchDepartments = async () => {
    try {
        const response = await fetch('/api/user-departments');
        return await response.json();
    } catch (error) {
        console.error('Error fetching departments:', error);
        return { departments: [] };
    }
};

export const fetchPositions = async () => {
    try {
        const response = await fetch('/api/user-positions');
        return await response.json();
    } catch (error) {
        console.error('Error fetching positions:', error);
        return { positions: [] };
    }
};
