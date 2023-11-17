@extends('layouts.home') @section('content')
<section class="mt-12 flex justify-center sm:mt-16">
    <div class="text-2xl font-black text-center max-w-4xl sm:text-4xl">
        <p>
            Overpicker is a hero composition calculator inspired in
            jazzmasta25's
            <a
                href="https://heropicker.com/"
                target="_blank"
                rel="noopener noreferrer"
                class="underline decoration-amber-400"
                >Hero Picker</a
            >
        </p>
    </div>
</section>
<section class="mb-10 text-center sm:text-left text-sm max-w-4xl m-auto">
    <div class="mt-12 pb-2 border-b-2 border-dashed sm:mt-16">
        <h2 class="font-normal text-2xl fjalla sm:text-3xl">Privacy Policy:</h2>
        <p>Last updated: {{$dates['PRIVACY_DATE']}}</p>
        <p class="mt-3 sm:text-lg">
            Autopoietico operates overpicker.win wich provides the service. This page informs you of our policies regarding the collection, use, and disclosure of Personal Information we receive from users of overpicker.win.
        </p>
        <p class="sm:text-lg">We use your Personal Information only for providing and improving overpicker.win. By using overpicker.win, you agree to the collection and use of information in accordance with this policy.</p>
    </div>
    <div class="mt-10 pb-2 border-b-2 border-dashed">
        <h2 class="font-normal text-2xl fjalla sm:text-3xl">Information Collection and Use</h2>
        <p class="mt-3 sm:text-lg">
            While using overpicker.win, we may ask you to provide us with certain personally identifiable information that can be used to contact or identify you. Personally identifiable information may include, but is not limited to your name, email address, and phone number ("Personal Information").
        </p>
    </div>
    <div class="mt-10 pb-2 border-b-2 border-dashed">
        <h2 class="font-normal text-2xl fjalla sm:text-3xl">Log Data</h2>
        <p class="mt-3 sm:text-lg">
            Like many site operators, we collect information that your browser sends whenever you visit overpicker.win ("Log Data"). This Log Data may include information such as your computer's Internet Protocol ("IP") address, browser type, browser version, the pages of overpicker.win that you visit, the time and date of your visit, the time spent on those pages, and other statistics.
        </p>
    </div>
    <div class="mt-10 pb-2 border-b-2 border-dashed">
        <h2 class="font-normal text-2xl fjalla sm:text-3xl">Cookies</h2>
        <p class="mt-3 sm:text-lg">
            Cookies are files with a small amount of data, which may include an anonymous unique identifier. Cookies are sent to your browser from a web site and stored on your computer's hard drive.
        </p>
        <p class="sm:text-lg">Like many sites, we use "cookies" to collect information. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of overpicker.win.</p>
    </div>
    <div class="mt-10 pb-2 border-b-2 border-dashed">
        <h2 class="font-normal text-2xl fjalla sm:text-3xl">Security</h2>
        <p class="mt-3 sm:text-lg">
            The security of your Personal Information is important to us, but remember that no method of transmission over the Internet, or method of electronic storage, is 100% secure. While we strive to use commercially acceptable means to protect your Personal Information, we cannot guarantee its absolute security.
        </p>
    </div>
    <div class="mt-10 pb-2 border-b-2 border-dashed">
        <h2 class="font-normal text-2xl fjalla sm:text-3xl">Changes to This Privacy Policy</h2>
        <p class="mt-3 sm:text-lg">
            This Privacy Policy is effective as of {{$dates['PRIVACY_DATE']}} and will remain in effect except with respect to any changes in its provisions in the future, which will be in effect immediately after being posted on this page.
        </p>
        <p class="sm:text-lg">We reserve the right to update or change our Privacy Policy at any time and you should check this Privacy Policy periodically. Your continued use of the Service after we post any modifications to the Privacy Policy on this page will constitute your acknowledgment of the modifications and your consent to abide and be bound by the modified Privacy Policy.</p>
    </div>
    <div class="mt-10 pb-2 border-b-2 border-dashed">
        <h2 class="font-normal text-2xl fjalla sm:text-3xl">Security</h2>
        <p class="mt-3 sm:text-lg">
            If you have any questions about this Privacy Policy, please contact us at <a href="mailto:autopoietico@outlook.com" class="underline decoration-amber-400">autopoietico@outlook.com</a>
        </p>
    </div>
</section>
@endsection
