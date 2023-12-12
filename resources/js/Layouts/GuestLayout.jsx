import ApplicationLogo from "@/components/ApplicationLogo";
import Navbar from "@/components/Navbar";
import { Link } from "@inertiajs/react";

export default function Guest({ children }) {
    return (
        <div className="min-h-screen flex flex-col sm:justify-center items-center bg-gray-900">
            <Navbar />
            <div className="mt-16 flex flex-col items-center justify-center">
                {" "}
                {/* Center the content */}
                <div>
                    <Link href="/">
                        <ApplicationLogo className="w-20 h-20 fill-current text-gray-500" />
                    </Link>
                </div>
                <div className="bg-gray-900 w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    {children}
                </div>
            </div>
        </div>
    );
}