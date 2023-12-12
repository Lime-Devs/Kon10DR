import ApplicationLogo from "@/components/ApplicationLogo";
import Navbar from "@/components/Navbar";
import { Link } from "@inertiajs/react";

export default function Guest({ children }) {
    return (
        <><Navbar /><div className="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-900">
            <div>
                <Link href="/">
                    <ApplicationLogo className="w-20 h-20 fill-current text-gray-500" />
                </Link>
            </div>

            <div className="bg-gray-900 w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {children}
            </div>
        </div></>
    );
}
