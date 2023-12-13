import { Head } from "@inertiajs/react";
import Navbar from "@/components/Navbar";
import {
    FaInstagram,
    FaTwitch,
    FaYoutube,
    FaTwitter,
    FaDiscord,
} from "react-icons/fa";
import YouTube from "react-youtube";
import Footer from "@/components/Footer";

export default function Watch({ auth, laravelVersion, phpVersion }) {
    const videoUrls = [
        "https://www.youtube.com/watch?v=YdGf0jvQVsM",
        "https://www.youtube.com/watch?v=uR7SeXt8Djw",
        "https://www.youtube.com/watch?v=MizpqbV4Wjc",
        "https://www.youtube.com/watch?v=HhMPqrzCX3w",
        "https://www.youtube.com/watch?v=0Za4sURGKgI",
        "https://www.youtube.com/watch?v=QYP0rnZsyE8",
        "https://www.youtube.com/watch?v=LzlsNWePq8o",
        "https://www.youtube.com/watch?v=cOThRsODxek",
    ];

    const extractVideoID = (url) => {
        const match = url.match(/(v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/);
        return match ? match[2] : null;
    };

    return (
        <div className="bg-gray-900 min-h-screen min-w-full flex flex-col py-16">
            <Head title="Watch" />
            <Navbar />
            <div className="container mx-auto px-4 py-10">
                <div className="text-center pb-10">
                    <h2 className="text-6xl font-bold mb-4 text-white">
                        WATCH
                    </h2>
                    <div className="text-center mb-8">
                        <h3 className="text-white mb-2">Share</h3>
                        <div className="flex justify-center items-center mb-4">
                            <a
                                href="https://www.instagram.com/_kon10dr/"
                                className="text-blue-500 hover:text-blue-600"
                            >
                                <FaInstagram size={24} />
                            </a>
                            <a
                                href="https://www.twitch.tv/kon10dr"
                                className="text-blue-500 hover:text-blue-600"
                            >
                                <FaTwitch size={24} />
                            </a>
                            <a
                                href="https://www.youtube.com/kon10dr"
                                className="text-blue-500 hover:text-blue-600"
                            >
                                <FaYoutube size={24} />
                            </a>
                            <a
                                href="https://twitter.com/kon10dr"
                                className="text-blue-500 hover:text-blue-600"
                            >
                                <FaTwitter size={24} />
                            </a>
                            <a
                                href="https://discord.com/invite/3FZY7BhyHH"
                                className="text-blue-500 hover:text-blue-600"
                            >
                                <FaDiscord size={24} />
                            </a>
                        </div>
                        <p className="text-white">
                            Content!! Content!! Content!!
                        </p>
                    </div>
                </div>

                <h3 className="text-xl text-white mb-4 text-center">
                    Past Live Streams
                </h3>
                <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    {videoUrls.map((url) => {
                        const videoId = extractVideoID(url);
                        return videoId ? (
                            <div className="w-full mb-6">
                                <YouTube
                                    key={videoId}
                                    videoId={videoId}
                                    opts={{
                                        height: "195",
                                        width: "100%",
                                    }}
                                    className="max-w-full sm:max-w-xs md:max-w-sm"
                                />
                            </div>
                        ) : null;
                    })}
                </div>
            </div>
            <Footer />
        </div>
    );
}
