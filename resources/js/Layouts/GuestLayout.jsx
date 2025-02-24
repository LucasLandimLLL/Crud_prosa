import ApplicationLogo from '@/Components/ApplicationLogo';
import { Link } from '@inertiajs/react';

export default function GuestLayout({ children }) {
    return (
        <div className="flex min-h-screen flex-col items-center bg-white pt-6 sm:justify-center sm:pt-0">
            <div>
                <Link href="/">
                    <ApplicationLogo className="h-20 w-20 fill-current text-gray-500 border border-lime-300 rounded-md" />
                </Link>
            </div>

            <div className="mt-6 w-full max-w-lg overflow-hidden bg-white px-6 py-4 shadow-md sm:rounded-lg">
                {children}
            </div>
        </div>
    );
}
