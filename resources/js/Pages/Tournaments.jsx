import React from "react";
import { Head } from "@inertiajs/react";
import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";
import BG1 from "../../images/BG1.jpg";
import BG2 from "../../images/BG2.png";
import BG3 from "../../images/BG3.jpg";
import BG4 from "../../images/BG4.jpg";
import BG5 from "../../images/BG5.jpg";
import BG6 from "../../images/BG6.jpg";

export default function Tournaments({ auth, laravelVersion, phpVersion }) {
    const tournamentImages = [BG1, BG3, BG4, BG5, BG6];
    const tournamentTitles = [];

    return (
        <div className="bg-gray-900 min-h-screen min-w-full py-16">
            <Head title="Tournament" />
            <Navbar />
            <div className="flex flex-col items-center justify-center py-16">
                <h1 className="text-white text-4xl mb-2">Tournaments</h1>
                <h2 className="text-orange-500 text-xl mb-8">
                    To get full access to our tournaments join our
                    challengermode.com space
                </h2>
                <div className="h-16 bg-orange-500 text-white tracking-wide rounded-full flex justify-center items-center px-8 font-bangers font-sans text-lg font-semibold shadow">
                    <a
                        href="https://invite.cm/Upnrtg?"
                        target="_blank"
                        className="button w-button"
                    >
                        JOIN OUR CHALLENGER MODE SPACE
                    </a>
                </div>
            </div>
            <section className="p-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                {tournamentImages.map((imageSrc, index) => (
                    <div
                        key={index}
                        className="rounded-lg box-content relative shadow hover:shadow-lg transform hover:scale-105 transition-transform duration-300 p-2 cursor-pointer"
                    >
                        <img
                            src={imageSrc}
                            alt={tournamentTitles[index]}
                            className="object-contain w-full h-full rounded-lg"
                        />
                        <div className="absolute bottom-0 left-0 bg-opacity-60 bg-black text-white p-1 text-xs sm:text-sm md:text-base font-semibold rounded-tl-lg">
                            {tournamentTitles[index]}
                        </div>
                    </div>
                ))}
            </section>
            <Footer />
        </div>
    );
}
