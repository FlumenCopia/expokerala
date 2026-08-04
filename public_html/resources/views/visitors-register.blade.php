@extends('user.user-master')
@push('styles')
<style>
    .visible {
        visibility: visible;
    }
    .hide {
        visibility: hidden;
    }
</style>
@endpush
@section('content')
 @include('layouts.header2')
    <!-- Meta Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1144503091041332');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=1144503091041332&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->

    <main class="vis-pg">
        <section class="vis-sec">
            <div class="container">
                <div class="visit-reg-contain">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="vist-form-contain">
                                <h2><span>Register</span> Now</h2>
                                <form action="/visitors-register" method="POST" id="visitorRegisterForm">
                                    @csrf
                                    <input type="hidden" name="country" id="country" value="India">
                                    <div class="vist-input">
                                        <select required name="countryCode" id="code">
                                            <option data-country="India" value="91" Selected>India (+91)</option>
                                            <option data-country="United Arab Emirates" value="971">United Arab Emirates
                                                (+971)
                                            </option>
                                            <option data-country="Malaysia" value="60">Malaysia (+60)</option>
                                            <option data-country="Indonesia" value="62">Indonesia (+62)</option>
                                            <optgroup label="Other countries">
                                                <option data-country="Algeria" value="213">Algeria (+213)</option>
                                                <option data-country="Andorra" value="376">Andorra (+376)</option>
                                                <option data-country="Angola" value="244">Angola (+244)</option>
                                                <option data-country="Anguilla" value="1264">Anguilla (+1264)</option>
                                                <option data-country="Antigua & Barbuda" value="1268">Antigua &amp;
                                                    Barbuda (+1268)
                                                </option>
                                                <option data-country="Armenia" value="54">Armenia (+54)</option>
                                                <option data-country="Armenia" value="374">Armenia (+374)</option>
                                                <option data-country="Aruba" value="297">Aruba (+297)</option>
                                                <option data-country="Australia" value="61">Australia (+61)</option>
                                                <option data-country="Austria" value="43">Austria (+43)</option>
                                                <option data-country="Azerbaijan" value="994">Azerbaijan (+994)
                                                </option>
                                                <option data-country="Bahamas" value="1242">Bahamas (+1242)</option>
                                                <option data-country="Bahrain" value="973">Bahrain (+973)</option>
                                                <option data-country="Bangladesh" value="880">Bangladesh (+880)
                                                </option>
                                                <option data-country="Barbados" value="1246">Barbados (+1246)</option>
                                                <option data-country="Belarus" value="375">Belarus (+375)</option>
                                                <option data-country="Belgium" value="32">Belgium (+32)</option>
                                                <option data-country="Belize" value="501">Belize (+501)</option>
                                                <option data-country="Benin" value="229">Benin (+229)</option>
                                                <option data-country="Bermuda" value="1441">Bermuda (+1441)</option>
                                                <option data-country="Bhutan" value="975">Bhutan (+975)</option>
                                                <option data-country="Bolivia" value="591">Bolivia (+591)</option>
                                                <option data-country="Bosnia Herzegovina" value="387">Bosnia
                                                    Herzegovina (+387)
                                                </option>
                                                <option data-country="Botswana" value="267">Botswana (+267)</option>
                                                <option data-country="Brazil" value="55">Brazil (+55)</option>
                                                <option data-country="Brunei" value="673">Brunei (+673)</option>
                                                <option data-country="Bulgaria" value="359">Bulgaria (+359)</option>
                                                <option data-country="Burkina Faso" value="226">Burkina Faso (+226)
                                                </option>
                                                <option data-country="Cambodia" value="257">Burundi (+257)</option>
                                                <option data-country="Cambodia" value="855">Cambodia (+855)</option>
                                                <option data-country="Cameroon" value="237">Cameroon (+237)</option>
                                                <option data-country="Canada" value="1">Canada (+1)</option>
                                                <option data-country="Cape Verde Islands" value="238">Cape Verde
                                                    Islands (+238)
                                                </option>
                                                <option data-country="Cayman Islands" value="1345">Cayman Islands
                                                    (+1345)</option>
                                                <option data-country="Central African Republic" value="236">Central
                                                    African Republic (+236)
                                                </option>
                                                <option data-country="Chile" value="56">Chile (+56)</option>
                                                <option data-country="China" value="86">China (+86)</option>
                                                <option data-country="Colombia" value="57">Colombia (+57)</option>
                                                <option data-country="Comoros" value="269">Comoros (+269)</option>
                                                <option data-country="Congo" value="242">Congo (+242)</option>
                                                <option data-country="Cook Islands" value="682">Cook Islands (+682)
                                                </option>
                                                <option data-country="Costa Rica" value="506">Costa Rica (+506)
                                                </option>
                                                <option data-country="Croatia" value="385">Croatia (+385)</option>
                                                <option data-country="Cuba" value="53">Cuba (+53)</option>
                                                <option data-country="Cyprus North" value="90392">Cyprus North
                                                    (+90392)
                                                </option>
                                                <option data-country="Cyprus South" value="357">Cyprus South (+357)
                                                </option>
                                                <option data-country="Czech Republic" value="42">Czech Republic
                                                    (+42)</option>
                                                <option data-country="Denmark" value="45">Denmark (+45)</option>
                                                <option data-country="Djibouti" value="253">Djibouti (+253)
                                                </option>
                                                <option data-country="DDominicaM" value="1809">Dominica (+1809)
                                                </option>
                                                <option data-country="Dominican Republic" value="1809">Dominican
                                                    Republic (+1809)
                                                </option>
                                                <option data-country="Ecuador" value="593">Ecuador (+593)</option>
                                                <option data-country="Egypt" value="20">Egypt (+20)</option>
                                                <option data-country="El Salvador" value="503">El Salvador (+503)
                                                </option>
                                                <option data-country="Equatorial Guinea" value="240">Equatorial
                                                    Guinea (+240)
                                                </option>
                                                <option data-country="Eritrea" value="291">Eritrea (+291)</option>
                                                <option data-country="Estonia" value="372">Estonia (+372)</option>
                                                <option data-country="Ethiopia" value="251">Ethiopia (+251)
                                                </option>
                                                <option data-country="Falkland Islands" value="500">Falkland
                                                    Islands (+500)
                                                </option>
                                                <option data-country="Faroe Islands" value="298">Faroe Islands
                                                    (+298)</option>
                                                <option data-country="Fiji" value="679">Fiji (+679)</option>
                                                <option data-country="Finland" value="358">Finland (+358)</option>
                                                <option data-country="France" value="33">France (+33)</option>
                                                <option data-country="French Guiana" value="594">French Guiana
                                                    (+594)</option>
                                                <option data-country="French Polynesia" value="689">French
                                                    Polynesia (+689)
                                                </option>
                                                <option data-country="Gabon" value="241">Gabon (+241)</option>
                                                <option data-country="Gambia" value="220">Gambia (+220)</option>
                                                <option data-country="Georgia" value="7880">Georgia (+7880)</option>
                                                <option data-country="Germany" value="49">Germany (+49)</option>
                                                <option data-country="Ghana" value="233">Ghana (+233)</option>
                                                <option data-country="Gibraltar" value="350">Gibraltar (+350)
                                                </option>
                                                <option data-country="Greece" value="30">Greece (+30)</option>
                                                <option data-country="Greenland" value="299">Greenland (+299)
                                                </option>
                                                <option data-country="Grenada" value="1473">Grenada (+1473)</option>
                                                <option data-country="Guadeloupe" value="590">Guadeloupe (+590)
                                                </option>
                                                <option data-country="Guam" value="671">Guam (+671)</option>
                                                <option data-country="Guatemala" value="502">Guatemala (+502)
                                                </option>
                                                <option data-country="Guinea" value="224">Guinea (+224)</option>
                                                <option data-country="Guinea - Bissau" value="245">Guinea - Bissau
                                                    (+245)
                                                </option>
                                                <option data-country="Guyana" value="592">Guyana (+592)</option>
                                                <option data-country="Haiti" value="509">Haiti (+509)</option>
                                                <option data-country="Honduras" value="504">Honduras (+504)
                                                </option>
                                                <option data-country="Hong Kong" value="852">Hong Kong (+852)
                                                </option>
                                                <option data-country="Hungary" value="36">Hungary (+36)</option>
                                                <option data-country="Iceland" value="354">Iceland (+354)</option>
                                                <option data-country="India" value="91">India (+91)</option>
                                                <option data-country="Indonesia" value="62">Indonesia (+62)
                                                </option>
                                                <option data-country="Iran" value="98">Iran (+98)</option>
                                                <option data-country="Iraq" value="964">Iraq (+964)</option>
                                                <option data-country="Ireland" value="353">Ireland (+353)</option>
                                                <option data-country="Israel" value="972">Israel (+972)</option>
                                                <option data-country="Italy" value="39">Italy (+39)</option>
                                                <option data-country="Jamaica" value="1876">Jamaica (+1876)</option>
                                                <option data-country="Japan" value="81">Japan (+81)</option>
                                                <option data-country="Jordan" value="962">Jordan (+962)</option>
                                                <option data-country="Kazakhstan" value="7">Kazakhstan (+7)
                                                </option>
                                                <option data-country="Kenya" value="254">Kenya (+254)</option>
                                                <option data-country="Kiribati" value="686">Kiribati (+686)
                                                </option>
                                                <option data-country="Korea North" value="850">Korea North (+850)
                                                </option>
                                                <option data-country="Korea South" value="82">Korea South (+82)
                                                </option>
                                                <option data-country="Kuwait" value="965">Kuwait (+965)</option>
                                                <option data-country="Kyrgyzstan" value="996">Kyrgyzstan (+996)
                                                </option>
                                                <option data-country="Laos" value="856">Laos (+856)</option>
                                                <option data-country="Latvia" value="371">Latvia (+371)</option>
                                                <option data-country="Lebanon" value="961">Lebanon (+961)</option>
                                                <option data-country="Lesotho" value="266">Lesotho (+266)</option>
                                                <option data-country="Liberia" value="231">Liberia (+231)</option>
                                                <option data-country="Libya" value="218">Libya (+218)</option>
                                                <option data-country="Liechtenstein" value="417">Liechtenstein
                                                    (+417)</option>
                                                <option data-country="Lithuania" value="370">Lithuania (+370)
                                                </option>
                                                <option data-country="Luxembourg" value="352">Luxembourg (+352)
                                                </option>
                                                <option data-country="Macao" value="853">Macao (+853)</option>
                                                <option data-country="Macedonia" value="389">Macedonia (+389)
                                                </option>
                                                <option data-country="Madagascar" value="261">Madagascar (+261)
                                                </option>
                                                <option data-country="Malawi" value="265">Malawi (+265)</option>
                                                <option data-country="Malaysia" value="60">Malaysia (+60)</option>
                                                <option data-country="Maldives" value="960">Maldives (+960)
                                                </option>
                                                <option data-country="Mali" value="223">Mali (+223)</option>
                                                <option data-country="Malta" value="356">Malta (+356)</option>
                                                <option data-country="Marshall Islands" value="692">Marshall
                                                    Islands (+692)
                                                </option>
                                                <option data-country="Martinique" value="596">Martinique (+596)
                                                </option>
                                                <option data-country="Mauritania" value="222">Mauritania (+222)
                                                </option>
                                                <option data-country="Mayotte" value="269">Mayotte (+269)</option>
                                                <option data-country="Mexico" value="52">Mexico (+52)</option>
                                                <option data-country="Micronesia" value="691">Micronesia (+691)
                                                </option>
                                                <option data-country="Moldova" value="373">Moldova (+373)</option>
                                                <option data-country="Monaco" value="377">Monaco (+377)</option>
                                                <option data-country="Mongolia" value="976">Mongolia (+976)
                                                </option>
                                                <option data-country="Montserrat" value="1664">Montserrat (+1664)
                                                </option>
                                                <option data-country="Morocco" value="212">Morocco (+212)</option>
                                                <option data-country="Mozambique" value="258">Mozambique (+258)
                                                </option>
                                                <option data-country="Myanmar" value="95">Myanmar (+95)</option>
                                                <option data-country="Namibia" value="264">Namibia (+264)</option>
                                                <option data-country="Nauru" value="674">Nauru (+674)</option>
                                                <option data-country="NepalNP" value="977">Nepal (+977)</option>
                                                <option data-country="Netherlands" value="31">Netherlands (+31)
                                                </option>
                                                <option data-country="New Caledonia" value="687">New Caledonia
                                                    (+687)</option>
                                                <option data-country="New Zealand" value="64">New Zealand (+64)
                                                </option>
                                                <option data-country="Nicaragua" value="505">Nicaragua (+505)
                                                </option>
                                                <option data-country="Niger" value="227">Niger (+227)</option>
                                                <option data-country="Nigeria" value="234">Nigeria (+234)</option>
                                                <option data-country="Niue" value="683">Niue (+683)</option>
                                                <option data-country="Norfolk Islands" value="672">Norfolk Islands
                                                    (+672)
                                                </option>
                                                <option data-country="Northern Marianas" value="670">Northern
                                                    Marianas (+670)
                                                </option>
                                                <option data-country="Norway" value="47">Norway (+47)</option>
                                                <option data-country="Oman" value="968">Oman (+968)</option>
                                                <option data-country="Palau" value="680">Palau (+680)</option>
                                                <option data-country="Panama" value="507">Panama (+507)</option>
                                                <option data-country="Papua New Guinea" value="675">Papua New
                                                    Guinea (+675)
                                                </option>
                                                <option data-country="Paraguay" value="595">Paraguay (+595)
                                                </option>
                                                <option data-country="Peru" value="51">Peru (+51)</option>
                                                <option data-country="Philippines" value="63">Philippines (+63)
                                                </option>
                                                <option data-country="Poland" value="48">Poland (+48)</option>
                                                <option data-country="Portugal" value="351">Portugal (+351)
                                                </option>
                                                <option data-country="Puerto Rico" value="1787">Puerto Rico (+1787)
                                                </option>
                                                <option data-country="Qatar" value="974">Qatar (+974)</option>
                                                <option data-country="Reunion" value="262">Reunion (+262)</option>
                                                <option data-country="Romania" value="40">Romania (+40)</option>
                                                <option data-country="Russia" value="7">Russia (+7)</option>
                                                <option data-country="Rwanda" value="250">Rwanda (+250)</option>
                                                <option data-country="San Marino" value="378">San Marino (+378)
                                                </option>
                                                <option data-country="Sao Tome Principe" value="239">Sao Tome &amp;
                                                    Principe
                                                    (+239)</option>
                                                <option data-country="Saudi Arabia" value="966">Saudi Arabia (+966)
                                                </option>
                                                <option data-country="Senegal" value="221">Senegal (+221)</option>
                                                <option data-country="Serbia" value="381">Serbia (+381)</option>
                                                <option data-country="Seychelles" value="248">Seychelles (+248)
                                                </option>
                                                <option data-country="Sierra Leone" value="232">Sierra Leone (+232)
                                                </option>
                                                <option data-country="Singapore" value="65">Singapore (+65)
                                                </option>
                                                <option data-country="Slovak Republic" value="421">Slovak Republic
                                                    (+421)
                                                </option>
                                                <option data-country="Slovenia" value="386">Slovenia (+386)
                                                </option>
                                                <option data-country="Solomon Islands" value="677">Solomon Islands
                                                    (+677)
                                                </option>
                                                <option data-country="Somalia" value="252">Somalia (+252)</option>
                                                <option data-country="South Africa" value="27">South Africa (+27)
                                                </option>
                                                <option data-country="Spain" value="34">Spain (+34)</option>
                                                <option data-country="Sri Lanka" value="94">Sri Lanka (+94)
                                                </option>
                                                <option data-country="St. Helena" value="290">St. Helena (+290)
                                                </option>
                                                <option data-country="St. Kitts" value="1869">St. Kitts (+1869)
                                                </option>
                                                <option data-country="St. Lucia" value="1758">St. Lucia (+1758)
                                                </option>
                                                <option data-country="Sudan" value="249">Sudan (+249)</option>
                                                <option data-country="Suriname" value="597">Suriname (+597)
                                                </option>
                                                <option data-country="Swaziland" value="268">Swaziland (+268)
                                                </option>
                                                <option data-country="Sweden" value="46">Sweden (+46)</option>
                                                <option data-country="Switzerland" value="41">Switzerland (+41)
                                                </option>
                                                <option data-country="Syria" value="963">Syria (+963)</option>
                                                <option data-country="Taiwan" value="886">Taiwan (+886)</option>
                                                <option data-country="Tajikstan" value="992">Tajikstan (+992)
                                                </option>
                                                <option data-country="Thailand" value="66">Thailand (+66)</option>
                                                <option data-country="Togo" value="228">Togo (+228)</option>
                                                <option data-country="Tonga" value="676">Tonga (+676)</option>
                                                <option data-country="Trinidad & Tobago" value="1868">Trinidad &amp;
                                                    Tobago (+1868)
                                                </option>
                                                <option data-country="Tunisia" value="216">Tunisia (+216)</option>
                                                <option data-country="Turkey" value="90">Turkey (+90)</option>
                                                <option data-country="Turkmenistan" value="993">Turkmenistan (+993)
                                                </option>
                                                <option data-country="Turks Caicos Islands" value="1649">Turks &amp;
                                                    Caicos Islands
                                                    (+1649)</option>
                                                <option data-country="Tuvalu" value="688">Tuvalu (+688)</option>
                                                <option data-country="Uganda" value="256">Uganda (+256)</option>
                                                <!-- <option data-country="GB" value="44">UK (+44)</option> -->
                                                <option data-country="Ukraine" value="380">Ukraine (+380)</option>
                                                <option data-country="United Arab Emirates" value="971">United Arab
                                                    Emirates (+971)
                                                </option>
                                                <option data-country="Uruguay" value="598">Uruguay (+598)</option>
                                                <!-- <option data-country="US" value="1">USA (+1)</option> -->
                                                <option data-country="Uzbekistan" value="998">Uzbekistan (+998)
                                                </option>
                                                <option data-country="Vanuatu" value="678">Vanuatu (+678)</option>
                                                <option data-country="Vatican City" value="379">Vatican City (+379)
                                                </option>
                                                <option data-country="Venezuela" value="58">Venezuela (+58)
                                                </option>
                                                <option data-country="Vietnam" value="84">Vietnam (+84)</option>
                                                <option data-country="Virgin Islands - British" value="1284">Virgin
                                                    Islands - British
                                                    (+1284)</option>
                                                <option data-country="Virgin Islands - US" value="1340">Virgin
                                                    Islands - US (+1340)
                                                </option>
                                                <option data-country="Wallis & Futuna" value="681">Wallis &amp;
                                                    Futuna (+681)
                                                </option>
                                                <option data-country="Yemen (North)" value="969">(+969)</option>
                                                <option data-country="Yemen (South)" value="967">Yemen
                                                    (South)(+967)</option>
                                                <option data-country="Zambia" value="260">Zambia (+260)</option>
                                                <option data-country="Zimbabwe" value="263">Zimbabwe (+263)
                                                </option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="vist-input option2">
                                        <input class="fr-rmv-str" type="number" placeholder="Your Phone" name="mobile"
                                            id="mobile" required>
                                        <span class="req-star phn">*</span>
                                    </div>
                                    <div class="vist-input option2">
                                        <input class="fr-rmv-str" type="text" name="name" placeholder="Your Name"
                                            required>
                                        <span class="req-star nm">*</span>
                                    </div>
                                    <div class="vist-input option2">
                                        {{-- <input type="text" name="visit_profile" placeholder="Visit Profile" required> --}}
                                        <select name="visit_profile" required id="prof-star-cvr">
                                            <option value="">Select Visit Profile</option>
                                            <option value="Component Manufacturer / Supplier">Component Manufacturer /
                                                Supplier</option>
                                            {{-- <option value="Distributor / Agent,End-User">Distributor / Agent,End-User</option> --}}
                                            <option value="EPC/ MNRE vendors / system integrator">EPC/ MNRE Eendors /
                                                system integrator </option>
                                            <option value="EPC professional / Employee">EPC professional / Employee</option>
                                            <option value="Masters Association member" style="font-weight: 600">Masters
                                                Association member</option>
                                            <option value="Government Organization">Government Organization</option>
                                            <option value="Investor / Project Developer">Investor / Project Developer
                                            </option>
                                            <option value="Distributor/wholesaler/trader">Distributor / wholesaler / trader
                                            </option>
                                            <option value="Media">Media</option>
                                            <option value="Student">Student</option>
                                            {{-- <option value="Customer / end-user">Customer / end-user</option> --}}
                                            <option value="Consumer">Consumer</option>
                                            <option value="Public">Public</option>
                                        </select>
                                        <span class="req-star vstr" id="prof-star">*</span>
                                    </div>

                                    {{-- <div class="vist-input option2">
                                        <select name="visit_profile" required id="repres-star-cvr">
                                            <option value="">Industry You Represent</option>
                                            <option value="Solar Energy">Solar Energy</option>
                                            <option value="Wind Energy">Wind Energy</option>
                                            <option value="Bio Energy">Bio Energy</option>
                                            <option value="Energy Storage and Electric & Hybrid Vehicle">Energy Storage and Electric & Hybrid Vehicle</option>
                                            <option value="Hydro Energy">Hydro Energy</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <span class="req-star vstr2" id="prof-star2">*</span>
                                    </div> --}}
                                    <div class="vist-input">
                                        <input class="fr-rmv-str" type="email" placeholder="Your Email"
                                            name="email" >
                                    </div>
                                    {{-- <div class="vist-input">
                                        <select name="customer_category" id="customer_category" required>
                                            <option value="">Select Your Category</option>
                                            <option value="Retailer">Retailer</option>
                                            <option value="Wholesaler">Wholesaler</option>
                                            <option value="Importer">Importer</option>
                                            <option value="Exporter">Exporter</option>
                                            <option value="Trader">Trader</option>
                                            <option value="Manufacturer">Manufacturer</option>
                                            <option value="Raw Materials">Raw Materials</option>
                                            <option value="Interior Designer">Interior Designer</option>
                                            <option value="Architect">Architect</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div> --}}
                                    <div class="vist-input ">
                                        <input class="fr-rmv-str" type="text" placeholder="Enter Company Name"
                                            name="company_name" required>
                                        <span class="req-star orgtn" id="prof-star">*</span>
                                    </div>
                                    <div class="vist-input">
                                        <input class="fr-rmv-str" type="text" placeholder="Enter Your Designation"
                                            name="designation" required>
                                        <span class="req-star dsgntn" id="prof-star">*</span>
                                    </div>
                                    <div class="vist-input">
                                        <textarea name="address" id="address" placeholder="Enter Address"></textarea>
                                    </div>
                                    <div class="vist-input">
                                        <input class="fr-rmv-str" type="text" placeholder="Post" name="post">
                                    </div>
                                    <div class="vist-input option2">
                                        <input class="fr-rmv-str" type="text" placeholder="City" name="city">
                                        {{-- <span class="req-star cit">*</span> --}}
                                    </div>
                                    <div class="vist-input">
                                        <input class="fr-rmv-str" type="text" placeholder="District/Region"
                                            name="district">
                                    </div>
                                    <div class="vist-input">
                                        <input class="fr-rmv-str" type="text" placeholder="State/Province"
                                            name="state">
                                    </div>
                                    <div class="vist-input">
                                        <input class="fr-rmv-str" type="number" placeholder="Pincode/Zipcode"
                                            name="pincode" required>
                                        <span class="req-star pncd" id="prof-star">*</span>
                                    </div>
                                    <div class="vist-input">
                                        <input class="fr-rmv-str" type="text" placeholder="Enter Landmark"
                                            name="landmark">
                                    </div>
                                    {{-- <div class="vist-input option2">
                                        <select name="visit_profile" required>
                                            <option value="">Meals</option>
                                            <option value="">Non-Veg</option>
                                            <option value="">Veg</option>

                                        </select>
                                    </div> --}}
                                    <div class="vist-input">
                                        <div style="display: flex;align-items: baseline;font-size: 14px;gap: 10px;">
                                            <input class="fr-rmv-str" type="checkbox" id="receiveupdate"
                                                name="receiveupdate" value="receiveupdate">
                                            <label for="receiveupdate" class="chck-lab">
                                                <p style="font-size: 14px;">I agree to receive all updates through sms and
                                                    Email</p>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="vist-input">
                                        <button type="submit" id="visit-btn" class="vist-regis-btn"
                                            disabled>Register</button>
                                        <button class="buttonload vist-regis-btn" style="display: none;"
                                            id="loading-btn">
                                            <i class="fa fa-spinner fa-spin"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-8">
                            <div class="visit-cont-contain">
                                <div class="visit-cont-blk">
                                    <div class="vis-img">
                                        <a href="/"><img src="{{ asset('assets/logo/logo3.png') }}"
                                                alt="masters"></a>
                                                {{-- <h2>State conference Registration</h2> --}}
                                    </div>
                                    <div class="vist-cont">
                                        <div class="vist-dt-blk">
                                            <div class="mnth">
                                                <span>January 2026</span>
                                            </div>
                                            <div class="vis-dt">
                                                <span>
                                                    <ul>
                                                        <li>9</li>
                                                        <li>10</li>
                                                        <li>11</li>
                                                    </ul>
                                                </span>
                                            </div>
                                        </div>

                                        <p>
                                            {{-- HIFF is the largest finished furniture exhibition in India and the most
                                            significant event in Indian furniture industry. --}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </section>
        <div class="badge-modal-contain">
            <div class="bdg-overlay"></div>
            <div class="bdg-modal">
                <div class="bdg-contain">
                    <div>
                        <span class="close"><i class="fa-solid fa-xmark"></i></span>
                    </div>

                    {{-- <div class="bdg-hd">
                        <div class="logo">
                            <img src="{{ asset('site/assets/hiff-log.svg') }}" alt="">
                        </div>
                        <div class="logo-sub">
                            <img src="{{ asset('site/assets/hiff-2025.png') }}" alt="Furniture Exhibition in India">
                        </div>
                    </div> --}}
                    <div class="bdge-cont">
                        <p>Registration Success</p>
                        {{-- <p>
                            HIFF is the largest finished furniture exhibition in India and the most significant event in
                            Indian furniture industry.
                        </p> --}}
                    </div>
                    <div class="vist-dt-blk">
                        <div class="mnth">
                            <span>January 2026</span>
                        </div>
                        <div class="vis-dt">
                            <span>
                                <ul>
                                    <li>9</li>
                                    <li>10</li>
                                    <li>11</li>
                                </ul>
                            </span>
                        </div>
                    </div>
                    <div class="generate-bdg">
                        <a id="generateBadge">generate Badge</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        $('#code').change(function(e) {
            e.preventDefault();
            var country = $(this).find(':selected').data('country');
            $('#country').val(country);
        });

        $('.bdg-contain .close').click(function() {
            $('.bdg-overlay').removeClass('show')
            $('.bdg-modal').removeClass('show')
        });

        $('#receiveupdate').change(function(e) {
            e.preventDefault();
            if ($(this).is(':checked')) {
                $('#visit-btn').removeAttr('disabled')
            } else {
                $('#visit-btn').attr('disabled', true);
            }
        });

        $('#mobile').keyup(function(e) {
            var text = $(this);
            var textLength = text.val().length;
            if (textLength >= 7) {
                $.ajax({
                    type: "post",
                    url: "/get-visitor",
                    data: {
                        mobile: text.val(),
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.status == true) {
                            $('#visitorRegisterForm').find('input[name="name"]').val(response.data
                                .name);
                            $('#visitorRegisterForm').find('input[name="email"]').val(response.data
                                .email);
                            $('#visitorRegisterForm').find('input[name="company_name"]').val(response
                                .data.firm_name);
                            $('#visitorRegisterForm').find('input[name="designation"]').val(response
                                .data.designation);
                            $('#visitorRegisterForm').find('textarea[name="address"]').val(response.data
                                .location);
                            $('#visitorRegisterForm').find('input[name="post"]').val(response.data
                                .post);
                            $('#visitorRegisterForm').find('input[name="city"]').val(response.data
                                .city);
                            $('#visitorRegisterForm').find('input[name="pincode"]').val(response.data
                                .pincode);
                            $('#visitorRegisterForm').find('input[name="landmark"]').val(response.data
                                .landmark);
                            $('#visitorRegisterForm').find('input[name="district"]').val(response.data
                                .district);
                            $('#visitorRegisterForm').find('input[name="state"]').val(response.data
                                .state);
                            // $('#visitorRegisterForm').find('select[name="customer_category"]').val(
                            //     response.data.category).trigger('change');
                            $('#visitorRegisterForm').find('select[name="visit_profile"]').val(
                                response.data.profile).trigger('change');
                            $('#visitorRegisterForm').find('select[name="countryCode"]').val(
                                response.data.mobile_code).trigger('change');
                        }
                    }
                });
            }
        });
        var result;
        $('#visitorRegisterForm').submit(function(e) {
            $('.bdg-modal').addClass('show')
            $('.bdg-overlay').addClass('show')
            e.preventDefault();
            $('#visit-btn').css('display', 'none');
            $('#loading-btn').css('display', 'block');
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function(data) {
                    if (data['status']) {
                        result = data;
                        let visitor = {
                            'name': result['visitor']['name'],
                            'profile': result['visitor']['visit_profile'],
                            'company_name': result['visitor']['company_name'],
                            'designation': result['visitor']['designation'],
                            'city': result['visitor']['city'],
                            'mobile_code': result['visitor']['countryCode'],
                            'mobile_number': result['visitor']['mobile'],
                        };

                        $('#generateBadge').attr('href', '/badge?qr_id=' + data['qr_id'] +
                            '&badge_no=' + data[
                                'badge_no'] + '&visitor=' + encodeURIComponent(JSON.stringify(
                                visitor)));
                        $('.bdg-overlay').addClass('show')
                        $('.bdg-modal').addClass('show')
                    } else {
                        alert(data['msg']);
                    }
                    $('#visit-btn').css('display', 'block');
                    $('#loading-btn').css('display', 'none');
                }
            });
        });

        $(document).on('change', '#prof-star-cvr', function(e) {
            var nonRequiredArray = ['Public', 'Consumer', 'Student', 'Media'];
            var val = $(this).val();
            if (val == '') {
                $('#prof-star').css('display', 'block')
                $('#member-div').css('display', 'none')
            } else {
                $('#prof-star').css('display', 'none')
                if (val == 'EPC / Masters Member / System Integrator') {
                    $('#member-div').css('display', 'block')
                } else {
                    $('#member-div').css('display', 'none')
                }
                if (nonRequiredArray.includes(val)) {
                    $('input[name="email"]').prop('required', false).next('.req-star').remove();
                    $('input[name="address"]').prop('required', false).next('.req-star').remove();
                    $('input[name="company_name"]').prop('required', false).next('.req-star').remove();
                    $('input[name="designation"]').prop('required', false).next('.req-star').remove();
                    $('input[name="post"]').prop('required', false).next('.req-star').remove();
                    $('input[name="city"]').prop('required', false).next('.req-star').remove();
                    $('input[name="landmark"]').prop('required', false).next('.req-star').remove();
                    // $('input[name="district"]').prop('required', false).next('.req-star').remove();
                    $('input[name="state"]').prop('required', false).next('.req-star').remove();
                   $('input[name="pincode"]').prop('required', false).next('.req-star').remove();
                } else {
                    let email = $('input[name="email"]').prop('required', true);
                    if (email.val() === '' && email.next('.req-star').length === 0) {
                        email.after('<span class="req-star nm">*</span>');
                    } else {
                        email.next('.req-star').remove();
                        email.after('<span class="req-star nm"></span>');
                    }
                    let company_name = $('input[name="company_name"]').prop('required', true);
                    if (company_name.val() === '' && company_name.next('.req-star').length === 0) {
                        company_name.after('<span class="req-star nm">*</span>');
                    } else {
                        company_name.next('.req-star').remove();
                        company_name.after('<span class="req-star nm"></span>');
                    }

                    let designation = $('input[name="designation"]').prop('required', true);
                    if (designation.val() === '' && designation.next('.req-star').length === 0) {
                        designation.after('<span class="req-star nm">*</span>');
                    } else {
                        designation.next('.req-star').remove();
                        designation.after('<span class="req-star nm"></span>');
                    }

                    let address = $('input[name="address"]').prop('required', true);
                    if (address.val() === '' && address.next('.req-star').length === 0) {
                        address.after('<span class="req-star nm">*</span>');
                    } else {
                        address.next('.req-star').remove();
                        address.after('<span class="req-star nm"></span>');
                    }

                    let post = $('input[name="post"]').prop('required', true);
                    if (post.val() === '' && post.next('.req-star').length === 0) {
                        post.after('<span class="req-star nm" style=" left: 46px;">*</span>');
                    } else {
                        post.next('.req-star').remove();
                        post.after('<span class="req-star nm" style=" left: 46px;"></span>');
                    }

                    let city = $('input[name="city"]').prop('required', true);
                    if (city.val() === '' && city.next('.req-star').length === 0) {
                        city.after('<span class="req-star nm" style=" left: 42px;">*</span>');
                    } else {
                        city.next('.req-star').remove();
                        city.after('<span class="req-star nm" style=" left: 42px;"></span>');
                    }

                    let landmark = $('input[name="landmark"]').prop('required', true);
                    if (landmark.val() === '' && landmark.next('.req-star').length === 0) {
                        landmark.after('<span class="req-star nm" style=" left: 117px;">*</span>');
                    } else {
                        landmark.next('.req-star').remove();
                        landmark.after('<span class="req-star nm" style=" left: 117px;"></span>');
                    }

                    let district = $('input[name="district"]').prop('required', true);
                    if (district.val() === '' && district.next('.req-star').length === 0) {
                        district.after('<span class="req-star nm" style=" left: 110px;">*</span>');
                    } else {
                        district.next('.req-star').remove();
                        district.after('<span class="req-star nm" style=" left: 110px;"></span>');
                    }

                    let state = $('input[name="state"]').prop('required', true);
                    if (state.val() === '' && state.next('.req-star').length === 0) {
                        state.after('<span class="req-star nm" style=" left: 110px;">*</span>');
                    } else {
                        state.next('.req-star').remove();
                        state.after('<span class="req-star nm" style=" left: 110px;"></span>');
                    }

                    let pincode = $('input[name="pincode"]').prop('required', true);
                    if (pincode.val() === '' && pincode.next('.req-star').length === 0) {
                        pincode.after('<span class="req-star nm" style=" left: 120px;">*</span>');
                    } else {
                        pincode.next('.req-star').remove();
                        pincode.after('<span class="req-star nm" style=" left: 120px;"></span>');
                    }

                }
            };
        });
        // $(document).on('change', '#repres-star-cvr', function(e) {
        //     var val = $(this).val();
        //     if (val == '') {
        //         $('#prof-star2').css('display', 'block')
        //     } else {
        //         $('#prof-star2').css('display', 'none')
        //     };
        // });

         $(document).on('keyup', '.fr-rmv-str', function() {
            let val = $(this).val().trim();

            let star = $(this).closest('.vist-input').find('.req-star');

            if (val === '') {
                star.text('*');
            } else {
                star.text('');
            }
        });
    </script>
@endsection
