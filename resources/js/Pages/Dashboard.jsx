import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

export default function Dashboard({ users }) {
    return (
        <AuthenticatedLayout
            header={<h2 className="text-xl font-semibold leading-tight text-black">Página principal</h2>}
            users={users} 
        >
            <Head title="Dashboard" />
            <div className="py-6">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
                    <div className="overflow-hidden sm:rounded-lg dark:bg-gray-800">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <a
                                href="/clientes"
                                className="text-blue-500 hover:text-blue-700"
                            >
                                Clique aqui para ver os clientes
                            </a>
                        </div>
                    </div>
                    <div className="overflow-hidden sm:rounded-lg dark:bg-gray-800">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <a
                                href="/usuarios"
                                className="text-blue-500 hover:text-blue-700"
                            >
                                Clique aqui para ver os usuários
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
