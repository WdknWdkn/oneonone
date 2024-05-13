import React from 'react';
import { InertiaLink } from '@inertiajs/inertia-react';

const Index = ({ interviews }) => {
    return (
        <div>
            {interviews.map((interview) => (
                <div key={interview.id}>
                    <h1>{interview.title}</h1>
                    <p>{interview.description}</p>
                    <InertiaLink href={`/interviews/${interview.id}/edit`}>Edit</InertiaLink>
                </div>
            ))}
        </div>
    );
};

export default Index;
