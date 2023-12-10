import React, { useState } from "react";
import { Head } from "@inertiajs/react";
import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";


export default function Tournaments({ auth, laravelVersion, phpVersion }) {
    return (
      <div className="bg-gray-900 min-h-screen min-w-full py-16">
        <div className="flex flex-col items-center justify-center py-16">
          <Head title="Tournament" />
          <Navbar />
          <h1 className="text-white text-4xl mb-2">Tournaments</h1>
          <h2 className="text-orange-500 text-xl mb-8">
            To get full access to our tournaments join our challengermode.com space
          </h2>
          <div class="h-16 bg-orange-500 text-white tracking-wide rounded-full flex justify-center 
          items-center px-8 font-bangers font-sans text-lg font-semibold shadow">
            <a href="https://invite.cm/Upnrtg?" target="_blank" class="button w-button">JOIN OUR CHALLENGER MODE SPACE</a>
          </div>
        </div>
        <Footer />
      </div>
    );
}
