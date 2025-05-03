@extends('layouts.user_layout')
@section('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@500;700&display=swap');

        .main {
            background: #e4e5f1;
            border-radius: 15px;
        }

        .heading {
            font-family: josefin sans;
        }

        .ol,
        .ul {
            font-family: josefin sans;
            font-size: 18px;
        }

        .ol>li {
            margin-bottom: 25px;
        }

        .ul>li {
            margin-top: 15px;
            margin-bottom: 15px;
        }
    </style>
@endsection
@section('content')
    <div>
        <div>
            <div class="bg-image p-5 text-center shadow-1-strong text-white"
                style="background-image: linear-gradient(to bottom right, rgb(201, 195, 195), rgb(22, 21, 21));">
                <h1 class="h2 mb-3">Terms And Conditions</h1>
            </div>
        </div>

        <div class="main">
            <div class="container">
                <ol class="ol pt-5">
                    <li>In consideration of your use of the beCoditive API, you represent that you are of legal age to form
                        a
                        binding contract and are not a person barred from receiving services under the laws of the Indian
                        Constitution or other applicable jurisdiction. You also agree to:
                        <ul class="ul">
                            <li>provide true, accurate, current and complete information about yourself as prompted by
                                beCoditive API's registration form and;</li>
                            <li>maintain and promptly update the Registration Data to keep it true, accurate, current and
                                complete. If you provide any information that is untrue, inaccurate, not current or
                                incomplete,
                                or beCoditive has reasonable grounds to suspect that such information is untrue, inaccurate,
                                not
                                current or incomplete, beCoditive has the right to suspend or terminate your account and
                                refuse
                                any and all current or future use of the beCoditive API (or any portion thereof).</li>
                        </ul>
                    </li>
                    <li>Any kind of abusing, harassment using beCoditive API is strictly prohibited. If anyone is found
                        conducting such acts, they will be banned from the beCoditive API and legal action will be taken
                        against them.</li>
                    <li> beCoditive API is copyrighted and if any acts of plagiarism are discovered, legal action will be
                        taken against the offender.
                    </li>
                    <li>Flooding beCoditive API with false requests and false complains is strictly prohibited</li>
                    <li>You expressly understand and agree that beCoditive and its subsidiaries, affiliates, officers,
                        employees, agents, partners and licensors shall not be liable to you for any direct, indirect,
                        incidental, special, consequential or exemplary damages, including, but not limited to, damages for
                        loss of profits, goodwill, use, data or other intangible losses (even if beCoditive has been advised
                        of the possibility of such damages), resulting from the use or the inability to use beCoditive API.
                    </li>
                    <li>You agree that beCoditive may terminate your access to beCoditive API for violations of the TOS
                        and/or requests by authorized law enforcement or other government agencies.</li>
                    <li>You acknowledge that beCoditive may establish general practices and limits concerning use of
                        beCoditive API, including without limitation the maximum number of days that email messages, message
                        board postings or other uploaded Content will be retained by beCoditive API. You further acknowledge
                        that beCoditive reserves the right to modify these general practices and limits from time to time.
                        beCoditive reserves the right at any time and from time to time to modify or discontinue,
                        temporarily or permanently, beCoditive API (or any part thereof) with or without notice. You agree
                        that beCoditive shall not be liable to you or to any third party for any modification, suspension or
                        discontinuance of beCoditive API.</li>
                </ol>
                <h4 class="heading text-center p-2">© Copyright 2024-2025 beCoditive. All rights reserved.</h4>
            </div>
        </div>
    </div>
@endsection
