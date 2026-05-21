@extends('layouts.home') @section('content')
<section class="mt-12 flex justify-center sm:mt-16">
    <div class="text-2xl font-black text-center max-w-4xl sm:text-4xl">
        <h1 class="fjalla uppercase text-4xl sm:text-5xl tracking-wide leading-tight">
            Privacy Policy
        </h1>
        <p class="text-slate-400 text-sm sm:text-base font-normal mt-2 poppins">
            Last updated: {{$dates['PRIVACY_DATE']}}
        </p>
    </div>
</section>

<section class="mb-16 text-center sm:text-left text-sm max-w-4xl m-auto px-4 mt-8">
    <div class="glass-panel p-6 sm:p-10 rounded-3xl border border-white/10 shadow-2xl space-y-8 text-slate-350 poppins leading-relaxed">
        <div>
            <p class="sm:text-lg text-slate-200">
                Autopoietico operates overpicker.com (previously overpicker.win) which provides this service. This page informs you of our policies regarding the collection, use, and disclosure of Personal Information we receive from users of the website.
            </p>
            <p class="sm:text-lg text-slate-200 mt-4">We use your Personal Information only for providing and improving the site. By using the site, you agree to the collection and use of information in accordance with this policy.</p>
        </div>

        <div class="pt-6 border-t border-white/5">
            <h2 class="font-normal text-2xl fjalla uppercase tracking-wider text-slate-100 mb-3">Information Collection and Use</h2>
            <p class="sm:text-lg">
                While using our site, we may ask you to provide us with certain personally identifiable information that can be used to contact or identify you. Personally identifiable information may include, but is not limited to your name, email address, and phone number ("Personal Information").
            </p>
        </div>

        <div class="pt-6 border-t border-white/5">
            <h2 class="font-normal text-2xl fjalla uppercase tracking-wider text-slate-100 mb-3">Log Data</h2>
            <p class="sm:text-lg">
                Like many site operators, we collect information that your browser sends whenever you visit overpicker.com ("Log Data"). This Log Data may include information such as your computer's Internet Protocol ("IP") address, browser type, browser version, the pages of the site that you visit, the time and date of your visit, the time spent on those pages, and other statistics.
            </p>
        </div>

        <div class="pt-6 border-t border-white/5">
            <h2 class="font-normal text-2xl fjalla uppercase tracking-wider text-slate-100 mb-3">Cookies</h2>
            <p class="sm:text-lg">
                Cookies are files with a small amount of data, which may include an anonymous unique identifier. Cookies are sent to your browser from a web site and stored on your computer's hard drive.
            </p>
            <p class="sm:text-lg mt-3">Like many sites, we use "cookies" to collect information. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of the website.</p>
        </div>

        <div class="pt-6 border-t border-white/5">
            <h2 class="font-normal text-2xl fjalla uppercase tracking-wider text-slate-100 mb-3">Security</h2>
            <p class="sm:text-lg">
                The security of your Personal Information is important to us, but remember that no method of transmission over the Internet, or method of electronic storage, is 100% secure. While we strive to use commercially acceptable means to protect your Personal Information, we cannot guarantee its absolute security.
            </p>
        </div>

        <div class="pt-6 border-t border-white/5">
            <h2 class="font-normal text-2xl fjalla uppercase tracking-wider text-slate-100 mb-3">Changes to This Privacy Policy</h2>
            <p class="sm:text-lg">
                This Privacy Policy is effective as of {{$dates['PRIVACY_DATE']}} and will remain in effect except with respect to any changes in its provisions in the future, which will be in effect immediately after being posted on this page.
            </p>
            <p class="sm:text-lg mt-3">We reserve the right to update or change our Privacy Policy at any time and you should check this Privacy Policy periodically. Your continued use of the Service after we post any modifications to the Privacy Policy on this page will constitute your acknowledgment of the modifications and your consent to abide and be bound by the modified Privacy Policy.</p>
        </div>

        <div class="pt-6 border-t border-white/5">
            <h2 class="font-normal text-2xl fjalla uppercase tracking-wider text-slate-100 mb-3">Contact Us</h2>
            <p class="sm:text-lg">
                If you have any questions about this Privacy Policy, please contact us at <a href="mailto:autopoietico@outlook.com" class="text-amber-400 hover:underline font-bold">autopoietico@outlook.com</a>.
            </p>
        </div>
    </div>
</section>
@endsection
