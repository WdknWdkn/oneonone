import React from 'react';
import NavLink from '@/Components/NavLink';

const Navigation = ({ user }) => (
    <div className="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <NavLink href={route('dashboard')} active={route().current('dashboard')}>
            Dashboard
        </NavLink>
        <NavLink href={route('interviews.index')} active={route().current('interviews.index')}>
            Interview
        </NavLink>
        {user.role !== 'user' && (
            <>
                <NavLink href={route('users.index')} active={route().current('users.index')}>
                    User
                </NavLink>
                <NavLink href={route('user-positions.index')} active={route().current('user-positions.index')}>
                    Position
                </NavLink>
                <NavLink href={route('rating-masters.index')} active={route().current('rating-masters.index')}>
                    RatingMaster
                </NavLink>
                <NavLink href={route('user-departments.index')} active={route().current('user-departments.index')}>
                    Department
                </NavLink>
                <NavLink href={route('templates.index')} active={route().current('templates.index')}>
                    Template
                </NavLink>
            </>
        )}
        {user.role === 'admin' && (
            <NavLink href={route('accounts.index')} active={route().current('accounts.index')}>
                Account
            </NavLink>
        )}
    </div>
);

export default Navigation;
