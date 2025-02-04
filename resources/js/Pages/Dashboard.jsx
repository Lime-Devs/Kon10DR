import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import dashboard2 from "../../images/dashboard2.jpeg";

export default function Dashboard({ auth }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="text-lg sm:font-semibold text-gray-800 leading-tight">
                    Dashboard
                </h2>
            }
        >
            <Head title="Dashboard" />

            <div className="py-4 sm:py-12 bg-dark-grey">
                <div className="px-4 sm:max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {/* Single Image with Overlay */}
                    <div className="relative w-full mx-auto h-1/2">
                        <img
                            src={dashboard2}
                            alt="Dashboard Image"
                            className="w-full h-full object-cover"
                        />
                        <div
                            style={{
                                border: "1px solid lightblue",
                                // backgroundColor: "rgba(255, 255, 255, 0.4)",
                                backdropFilter: "blur(5px)",
                            }}
                            className="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-24 w-3/4 text-center z-10 rounded-lg" // Increased padding and width for a bigger box
                        >
                            <h2 style={{ color: "orange" }}>
                                Your Ultimate Esports Destination
                            </h2>
                            <p
                                style={{
                                    color: "white",
                                    fontSize: "1.5em",
                                    fontWeight: "bold",
                                }}
                            >
                                KON1ODR.COM
                            </p>{" "}
                            <p style={{ color: "white" }}>
                                Every Champion was once a Kon10dr so start your
                                Esports career here
                            </p>
                            <p style={{
                              color: "orange",
                              fontSize: "4em",
                              fontWeight: "bold"
                            }}> Coming Soon!! </p>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}

function renderSection(title, content) {
    return (
        <div className="mb-4 sm:mb-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div className="p-4 sm:p-6 text-gray-900">
                <h3 className="text-gray-900 font-medium sm:font-semibold mb-4">
                    {title}
                </h3>
                {content}
            </div>
        </div>
    );
}
