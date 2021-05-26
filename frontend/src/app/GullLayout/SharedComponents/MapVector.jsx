import React, { Fragment } from "react";
import { OverlayTrigger, Tooltip, Alert, Popover } from "react-bootstrap";
import { Link } from "react-router-dom";

const MapVector = ({ data }) => {

    return (
        <div className="svg-container">
            <svg xmlns="http://www.w3.org/2000/svg" xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 643.749 531.496">
                <defs>
                    <filter id="Union_27" x="430.177" y="346.317" width="174" height="73.071" filterUnits="userSpaceOnUse">
                        <feOffset dy="2" input="SourceAlpha" />
                        <feGaussianBlur stdDeviation="2" result="blur" />
                        <feFlood floodOpacity="0.102" />
                        <feComposite operator="in" in2="blur" />
                        <feComposite in="SourceGraphic" />
                    </filter>
                    <filter id="Union_32" x="219.177" y="400.316" width="75.999" height="42.072"
                        filterUnits="userSpaceOnUse">
                        <feOffset dy="2" input="SourceAlpha" />
                        <feGaussianBlur stdDeviation="2" result="blur-2" />
                        <feFlood floodOpacity="0.102" />
                        <feComposite operator="in" in2="blur-2" />
                        <feComposite in="SourceGraphic" />
                    </filter>
                    <filter id="Union_30" x="281.177" y="457.316" width="83.999" height="44.072"
                        filterUnits="userSpaceOnUse">
                        <feOffset dy="2" input="SourceAlpha" />
                        <feGaussianBlur stdDeviation="2" result="blur-3" />
                        <feFlood floodOpacity="0.102" />
                        <feComposite operator="in" in2="blur-3" />
                        <feComposite in="SourceGraphic" />
                    </filter>
                    <filter id="Union_36" x="159.177" y="126.316" width="83.999" height="48.072"
                        filterUnits="userSpaceOnUse">
                        <feOffset dy="2" input="SourceAlpha" />
                        <feGaussianBlur stdDeviation="2" result="blur-4" />
                        <feFlood floodOpacity="0.102" />
                        <feComposite operator="in" in2="blur-4" />
                        <feComposite in="SourceGraphic" />
                    </filter>
                    <filter id="Union_35" x="214.333" y="192.333" width="95.377" height="79.663"
                        filterUnits="userSpaceOnUse">
                        <feOffset dy="2" input="SourceAlpha" />
                        <feGaussianBlur stdDeviation="2" result="blur-5" />
                        <feFlood floodOpacity="0.102" />
                        <feComposite operator="in" in2="blur-5" />
                        <feComposite in="SourceGraphic" />
                    </filter>
                    <filter id="Union_27-2" x="238.177" y="191.317" width="127" height="67.07" filterUnits="userSpaceOnUse">
                        <feOffset dy="2" input="SourceAlpha" />
                        <feGaussianBlur stdDeviation="2" result="blur-6" />
                        <feFlood floodOpacity="0.102" />
                        <feComposite operator="in" in2="blur-6" />
                        <feComposite in="SourceGraphic" />
                    </filter>
                    <filter id="Union_28" x="292.176" y="449.316" width="102.999" height="58.072"
                        filterUnits="userSpaceOnUse">
                        <feOffset dy="2" input="SourceAlpha" />
                        <feGaussianBlur stdDeviation="2" result="blur-7" />
                        <feFlood floodOpacity="0.102" />
                        <feComposite operator="in" in2="blur-7" />
                        <feComposite in="SourceGraphic" />
                    </filter>
                    <filter id="Union_37" x="28.177" y="131.316" width="83.999" height="48.072"
                        filterUnits="userSpaceOnUse">
                        <feOffset dy="2" input="SourceAlpha" />
                        <feGaussianBlur stdDeviation="2" result="blur-8" />
                        <feFlood floodOpacity="0.102" />
                        <feComposite operator="in" in2="blur-8" />
                        <feComposite in="SourceGraphic" />
                    </filter>
                    <filter id="Union_34" x="104.177" y="244.316" width="83.999" height="44.072"
                        filterUnits="userSpaceOnUse">
                        <feOffset dy="2" input="SourceAlpha" />
                        <feGaussianBlur stdDeviation="2" result="blur-9" />
                        <feFlood floodOpacity="0.102" />
                        <feComposite operator="in" in2="blur-9" />
                        <feComposite in="SourceGraphic" />
                    </filter>
                    <filter id="Union_33" x="166.177" y="334.316" width="83.999" height="44.072"
                        filterUnits="userSpaceOnUse">
                        <feOffset dy="2" input="SourceAlpha" />
                        <feGaussianBlur stdDeviation="2" result="blur-10" />
                        <feFlood floodOpacity="0.102" />
                        <feComposite operator="in" in2="blur-10" />
                        <feComposite in="SourceGraphic" />
                    </filter>
                    <filter id="Union_29" x="219.176" y="419.867" width="83.716" height="48.072"
                        filterUnits="userSpaceOnUse">
                        <feOffset dy="2" input="SourceAlpha" />
                        <feGaussianBlur stdDeviation="2" result="blur-11" />
                        <feFlood floodOpacity="0.102" />
                        <feComposite operator="in" in2="blur-11" />
                        <feComposite in="SourceGraphic" />
                    </filter>
                    <filter id="Union_38" x="90.177" y="71.316" width="87" height="48.072" filterUnits="userSpaceOnUse">
                        <feOffset dy="2" input="SourceAlpha" />
                        <feGaussianBlur stdDeviation="2" result="blur-12" />
                        <feFlood floodOpacity="0.102" />
                        <feComposite operator="in" in2="blur-12" />
                        <feComposite in="SourceGraphic" />
                    </filter>
                    <filter id="Union_39" x="209.177" y="85.316" width="83.999" height="44.072"
                        filterUnits="userSpaceOnUse">
                        <feOffset dy="2" input="SourceAlpha" />
                        <feGaussianBlur stdDeviation="2" result="blur-13" />
                        <feFlood floodOpacity="0.102" />
                        <feComposite operator="in" in2="blur-13" />
                        <feComposite in="SourceGraphic" />
                    </filter>
                </defs>
                <g id="saudi_map_vector" data-name="saudi map vector" transform="translate(-120.823 -311.983)">
                    <path id="Path_374" data-name="Path 374"
                        d="M265,312.3c-3.3,7.2-18.4,13.4-38,19.2-1,.3-2,.6-3.1.9-8.7,2.5-18.1,4.9-27.6,7.3L225,377c-9.2,1.6-12.7,7.3-12.7,15.3l-25.3,4c-5.6,15.7-11.5,25.2-18,24.7l-37.3-4.7c-.2,23.4-2.1,41.4-8.7,43.3,15-.8,26.5,4.2,29.3,24,24,28.8,40.6,61.5,53.3,96,38.3,30.7,59.5,60.3,50,88,5.8,29.6,55,69.4,53.3,68l26,54c19.2,12.7,30.9,30.9,36.7,53.3l11.3-5.3c1.2-9.9,2.6-20.5,4-32l12.7,7.3,46-2.7c14.3,5.6,29.6,7.1,46,4.7l8,8.7c12.9,5.1,16,4.1,12-1.3l26-34.7,26-14c8.3-1.1,28.4-3.7,56.7-7.3,25.9,4.5,74.9-16.3,124.7-38l19.3-64L749,639.7l-5.3,4.7-73.3-14-30.7-36.7c-.1-7.7-3.9-9.8-10.7-7.3l8.7-8.7H619L607.7,563c5.1-3.7-1.2-15.9-12.7-32,9.3-13.3,4.9-28-24.7-43.3,3.3-6.8-2-11.7-15.3-14.7l-8-21.3-4-8.7H519.7c3.3-10.5-7.2-16.9-31.3-19.3l-12.7,6.7L427,419.7,286.3,320.4C277.8,317.1,270.4,314.4,265,312.3Z"
                        fill="none" stroke="#4d4d4d" strokeMiterlimit="10" strokeWidth="0.5" />
                    <path id="Path_376" data-name="Path 376" d="M309,437.7l-6.3-4Z" fill="none" stroke="#4d4d4d"
                        strokeMiterlimit="10" strokeWidth="0.5" />
                    <path id="Path_383" data-name="Path 383" d="M388.3,699.7l7-6.4Z" fill="none" stroke="#4d4d4d"
                        strokeMiterlimit="10" strokeWidth="0.5" />
                    <path id="Path_384" data-name="Path 384" d="M380.7,699.7h0Z" fill="none" stroke="#4d4d4d"
                        strokeMiterlimit="10" strokeWidth="0.5" />
                    <path id="Path_386" data-name="Path 386" d="M309,735.7" fill="none" stroke="#4d4d4d"
                        strokeMiterlimit="10" strokeWidth="0.5" />
                    <path id="Path_387" data-name="Path 387" d="M305.9,740.4" fill="none" stroke="#4d4d4d"
                        strokeMiterlimit="10" strokeWidth="0.5" />
                    <path id="Path_388" data-name="Path 388" d="M322.3,745.8l-7-5.8Z" fill="none" stroke="#4d4d4d"
                        strokeMiterlimit="10" strokeWidth="0.5" />
                    <path id="Path_394" data-name="Path 394" d="M375.7,789.7l11.3,16Z" fill="none" stroke="#4d4d4d"
                        strokeMiterlimit="10" strokeWidth="0.5" />

                    <OverlayTrigger trigger="click" placement={"top"} overlay={
                        <Popover id="popover-basic">
                            <Popover.Title as="h3" className="text-center">المنطقة الشرقية</Popover.Title>
                            <Popover.Content>
                                <Link to="/" className="btn btn-primary">
                                    الطلبات {data['الشرقية'].requests}
                                </Link>
                                <Link to="/" className="btn btn-success m-1">
                                    العروض المرسلة {data['الشرقية'].offer}
                                </Link>
                            </Popover.Content>
                        </Popover>
                    }>
                        <g id="the_eastern_zone" data-name="Component 20 – 14" transform="translate(440.3 423.7)">

                            <path id="Path_381" className="hover" data-name="Path 381"
                                d="M440.3,479l8.7,10.7,8.7,3.7,8,8.3h10l11.3,8.7h8l6,6c15.1,1.5,16.7,10.9,12.7,23.7l1.9,34.3c13.5,5.5,23,13.5,24.1,26.7L529,698.3,514.2,818.9l23.4-31.3,26-14,56.7-7.3c32.7,2,77.6-16.2,124.7-38l19.3-64L749,639.7l-5.3,4.7-73.3-14-30.7-36.7c1.7-6.1-3.3-7.5-10.7-7.3l8.7-8.7H619L607.7,563c2.9-8.6-2.7-19.7-12.7-32,8.5-18.7-.5-32.9-24.7-43.3,4.8-5.3-1.1-10.2-15.3-14.7l-12-30H519.7c7.7-8.3-7.9-14.3-31.3-19.3l-12.7,6.7-6.2-1.4L455,443.7l-14.7,28.7Z"
                                transform="translate(-440.3 -423.7)" fill="#f2f2f2" stroke="#4d4d4d" strokeMiterlimit="10"
                                strokeWidth="0.5" tabIndex="0" data-toggle="popover" data-trigger="hover"
                                data-popover-content="#the_eastern_zone_popover" data-placement="top" cx="487" cy="198.5" r="1.9" />
                        </g>
                    </OverlayTrigger>

                    <OverlayTrigger trigger="click" placement={"top"} overlay={
                        <Popover id="popover-basic">
                            <Popover.Title as="h3" className="text-center">الباحة</Popover.Title>
                            <Popover.Content>
                                <Link to="/" className="btn btn-primary">
                                    الطلبات {data['الباحة'].requests}
                                </Link>
                                <Link to="/" className="btn btn-success m-1">
                                    العروض المرسلة {data['الباحة'].offer}
                                </Link>
                            </Popover.Content>
                        </Popover>
                    }>
                        <g id="Al-Baha" data-name="Component 26 – 14" transform="translate(312.4 703.456)">

                            <path id="Path_389" className="hover" data-name="Path 389"
                                d="M329,743l14.3-20,8.4-5.3-3.3-9H331.7c-10.2-11.1-10.1-2.9-8,9l-11.3,8.7,4.7,7.3-1.6,6.4,7,5.8Z"
                                transform="translate(-312.4 -703.456)" fill="#999" stroke="#4d4d4d" strokeMiterlimit="10"
                                strokeWidth="0.5" tabIndex="0" data-toggle="popover" data-trigger="hover"
                                data-popover-content="#Al-Baha_popover" data-placement="top" cx="487" cy="198.5" r="1.9" />
                        </g>
                    </OverlayTrigger>

                    <OverlayTrigger trigger="click" placement={"top"} overlay={
                        <Popover id="popover-basic">
                            <Popover.Title as="h3" className="text-center">جازان</Popover.Title>
                            <Popover.Content>
                                <Link to="/" className="btn btn-primary">
                                    الطلبات {data['جازان'].requests}
                                </Link>
                                <Link to="/" className="btn btn-success m-1">
                                    العروض المرسلة {data['جازان'].offer}
                                </Link>
                            </Popover.Content>
                        </Popover>
                    }>
                        <g id="Jazan" data-name="Component 25 – 14" transform="translate(335.1 769.3)">

                            <path id="Path_395" className="hover" data-name="Path 395"
                                d="M369.7,797.7v6.7l-7.3-7.3-10.7-3.3-5.9-4-3.2-8-7.5,8c21.8,18.8,35.3,36.8,36.7,53.3l11.3-5.3,4-32-11.3-16Z"
                                transform="translate(-335.1 -769.3)" fill="#e6e6e6" stroke="#4d4d4d" strokeMiterlimit="10"
                                strokeWidth="0.5" tabIndex="0" data-toggle="popover" data-trigger="hover"
                                data-popover-content="#Jazan_popover" data-placement="top" cx="487" cy="198.5" r="1.9" />
                        </g>
                    </OverlayTrigger>

                    <OverlayTrigger trigger="click" placement={"top"} overlay={
                        <Popover id="popover-basic">
                            <Popover.Title as="h3" className="text-center">حائل</Popover.Title>
                            <Popover.Content>
                                <Link to="/" className="btn btn-primary">
                                    الطلبات {data['حائل'].requests}
                                </Link>
                                <Link to="/" className="btn btn-success m-1">
                                    العروض المرسلة {data['حائل'].offer}
                                </Link>
                            </Popover.Content>
                        </Popover>
                    }>
                        <g id="Hail" data-name="Component 30 – 14" transform="translate(257.7 433.6)">

                            <path id="Path_378" className="hover" data-name="Path 378"
                                d="M257.7,455.7c18.2,6.4,25.8,12.9,22.7,19.3l4.7,8,6.7,8.7-7.5,19.6-2.5,6.4,4,4-2,8L285,553h10l10.9-2.7,3.1-4.7h20l16.7-5.7c-5.2-5.5-4.7-9.1,7.3-8.3l3.3-10.7c5.3-10.7,14.9-18,31.3-20-2-6.6,3.2-12.6,18.7-18,8.6,12.4,15.8,15.2,21.3,7.3-3.5-7.7-.6-10.4,4.7-11.3l-7.3-8-15.3-4c1.8-6.5-2-12.3-10.7-17.3H381.7l-4-5.3H366.4c-2.2-6.7-8.2-9.1-16.7-8.7l-18.7-2-22,4-6.3-4Z"
                                transform="translate(-257.7 -433.6)" fill="#fff" stroke="#4d4d4d" strokeMiterlimit="10"
                                strokeWidth="0.5" tabIndex="0" data-toggle="popover" data-trigger="hover"
                                data-popover-content="#Hail_popover" data-placement="top" cx="487" cy="198.5" r="1.9" />
                        </g>
                    </OverlayTrigger>

                    <OverlayTrigger trigger="click" placement={"top"} overlay={
                        <Popover id="popover-basic">
                            <Popover.Title as="h3" className="text-center">القصيم</Popover.Title>
                            <Popover.Content>
                                <Link to="/" className="btn btn-primary">
                                    الطلبات {data['القصيم'].requests}
                                </Link>
                                <Link to="/" className="btn btn-success m-1">
                                    العروض المرسلة {data['القصيم'].offer}
                                </Link>
                            </Popover.Content>
                        </Popover>
                    }>
                        <g id="Qassim" data-name="Component 29 – 14" transform="translate(329 483.1)">

                            <path id="Path_380" className="hover" data-name="Path 380"
                                d="M427.7,490.3q9.3,6,0,12l-8,6v12L429,529l.7,11,2.7,5H407c-1.4,7-10.1,11.5-22.7,14.7l-4,5,3.3,9.7h-24c-3.2-2.8-7.8-4.8-11.3-1.3l-5-8.3c-3.9,4.5-5.6-4.1-7-15l-7.3-4,16.7-5.7c-3.3-9.5.9-10.2,7.3-8.3l3.3-10.7c9-13.9,19.6-20,31.3-20-4.3-5.3,3.9-11.5,18.7-18C414.1,492.6,421.5,497.2,427.7,490.3Z"
                                transform="translate(-329 -483.1)" fill="#e6e6e6" stroke="#4d4d4d" strokeMiterlimit="10"
                                strokeWidth="0.5" tabIndex="0" data-toggle="popover" data-trigger="hover"
                                data-popover-content="#Qassim_popover" data-placement="top" cx="487" cy="198.5" r="1.9" />
                        </g>
                    </OverlayTrigger>

                    <OverlayTrigger trigger="click" placement={"top"} overlay={
                        <Popover id="popover-basic">
                            <Popover.Title as="h3" className="text-center">الرياض</Popover.Title>
                            <Popover.Content>
                                <Link to="/" className="btn btn-primary">
                                    الطلبات {data['الرياض'].requests}
                                </Link>
                                <Link to="/" className="btn btn-success m-1">
                                    العروض المرسلة {data['الرياض'].offer}
                                </Link>
                            </Popover.Content>
                        </Popover>
                    }>
                        <g id="Riyadh" data-name="Component 21 – 14" transform="translate(348.3 478.9)">
                            <path id="Path_382" className="hover" data-name="Path 382"
                                d="M348.3,573l11.3,1.3h24l-3.3-9.7,4-5c16.1-4.6,22.6-9.5,22.7-14.7h25.3l-2.7-5-.7-11-9.3-8.7v-12l8-6c4.1-2.2,8.5-4.2,0-12-2.9-4.4-3.5-8.4,4.7-11.3,2.3,5.9,5.1,4.7,8,0l8.7,10.7,8.7,3.7,8,8.3h10l11.3,8.7h8l6,6c12.7.8,17.5,8.3,12.7,23.7l1.9,34.3c13.5,3.9,20.9,13.4,24.1,26.7L523.5,743.9l-45.1,6.5H435.7c-20.1-9.5-33.9-21.4-26.7-42l-13.7-15.1-6.3-6.9,3.3-21.3V646.4H377.6l-2.7-4c13.8-8.8,2.1-10.2-15.3-10l-8-20.7L348.3,599V573Z"
                                transform="translate(-348.3 -478.9)" fill="#cecece" tabIndex="0" data-toggle="popover"
                                data-trigger="hover" data-popover-content="#Riyadh_popover" data-placement="top" cx="487" cy="198.5"
                                r="1.9" />

                        </g>
                    </OverlayTrigger>

                    <OverlayTrigger trigger="click" placement={"top"} overlay={
                        <Popover id="popover-basic">
                            <Popover.Title as="h3" className="text-center">نجران</Popover.Title>
                            <Popover.Content>
                                <Link to="/" className="btn btn-primary">
                                    الطلبات {data['نجران'].requests}
                                </Link>
                                <Link to="/" className="btn btn-success m-1">
                                    العروض المرسلة {data['نجران'].offer}
                                </Link>
                            </Popover.Content>
                        </Popover>
                    }>
                        <g id="Najran" data-name="Component 23 – 14" transform="translate(395.2 743.8)">
                            <path id="Path_392" className="hover" data-name="Path 392"
                                d="M424.3,745.8l11.3,4.5h42.7l45.1-6.5-9.2,75-2.6,3.4c3.8,6.7-2.1,5.6-12,1.3l-8-8.7c-15,2.7-30.3.9-46-4.7l-46,2.7-4.4-2.5,5-3.5-5-6,3.7-8-3.7-8.7L407,775c-.7-4.5,1.9-7.5,12.7-6.7V755"
                                transform="translate(-395.2 -743.8)" fill="#b3b3b3" stroke="#4d4d4d" strokeMiterlimit="10"
                                strokeWidth="0.5" tabIndex="0" data-toggle="popover" data-trigger="hover"
                                data-popover-content="#Najran_popover" data-placement="top" cx="487" cy="198.5" r="1.9" />
                        </g>
                    </OverlayTrigger>

                    <OverlayTrigger trigger="click" placement={"top"} overlay={
                        <Popover id="popover-basic">
                            <Popover.Title as="h3" className="text-center">تبوك</Popover.Title>
                            <Popover.Content>
                                <Link to="/" className="btn btn-primary">
                                    الطلبات {data['تبوك'].requests}
                                </Link>
                                <Link to="/" className="btn btn-success m-1">
                                    العروض المرسلة {data['تبوك'].offer}
                                </Link>
                            </Popover.Content>
                        </Popover>
                    }>
                        <g id="Tabuk" data-name="Component 31 – 14" transform="translate(123 429)">

                            <path id="Path_393" className="hover" data-name="Path 393"
                                d="M202.3,483l-12,5.3,4.7,5c-.4,14.8,3,26.2,9.3,35h5.3l13.3,17.3c4.2,9.9,4.5,18.3.7,25.3h-8.1l-9.9,8.7a321.384,321.384,0,0,0-53.3-96c-.7-13.9-7.8-23.7-29.3-24,7.1-10.7,9.1-19.5,8.2-27.2l9.2-.1,11.3-3.3c14.8.9,23.5,5.7,24.7,15.3,10.8-4.5,21.2-6,30.7,0,8-17.5,11.9-12.4,13.3,6.7l27.3,4.7h10c14.8,7.4,28.9,14.7,22.7,19.3,0,0-2-.7,4.7,8l6.7,8.7-7.5,19.6-9.1-4.9H257.9L247,497l-9.8,9.3-8.2-13c-6.5,3.1-8-2.8-8.7-10.3-5.4,4.8-4.6,4.3,0,0-5.3,4.5-12.2,4.2-20.1.9l-9.9,4.4s6.4,30.1,14,40h5.3l5.9,6,7.4,11.3c3.2,14.4,4.1,24.2.7,25.3,0,0,1.8-8.7-8.1,0l-9.9,8.7a321.384,321.384,0,0,0-53.3-96c-.9-14.6-8.8-24-29.3-24"
                                transform="translate(-123 -429)" fill="#e6e6e6" stroke="#4d4d4d" strokeMiterlimit="10"
                                strokeWidth="0.5" tabIndex="0" data-toggle="popover" data-trigger="hover"
                                data-popover-content="#Tabuk_popover" data-placement="top" cx="487" cy="198.5" r="1.9" />
                        </g>
                    </OverlayTrigger>

                    <OverlayTrigger trigger="click" placement={"top"} overlay={
                        <Popover id="popover-basic">
                            <Popover.Title as="h3" className="text-center">المدينة المنورة</Popover.Title>
                            <Popover.Content>
                                <Link to="/" className="btn btn-primary">
                                    الطلبات {data['المدينة المنورة'].requests}
                                </Link>
                                <Link to="/" className="btn btn-success m-1">
                                    العروض المرسلة {data['المدينة المنورة'].offer}
                                </Link>
                            </Popover.Content>
                        </Popover>
                    }>
                        <g id="Medina" data-name="Component 28 – 14" transform="translate(190.4 483.1)">

                            <path id="Path_379" className="hover" data-name="Path 379"
                                d="M275,506.3H257.7L247,497l-3.3,4.7-6.4,4.7-8.2-13c-3.3,5.2-6.2,1.8-8.7-10.3-4.4,4.3-10.3,4.6-18,0l-12,5.3,4.7,5c.2,15.1,3.6,31.9,9.3,35h5.3l5.9,6,7.4,11.3c3.8,8.4,4.8,16.9.7,25.3h-8.1l-9.9,8.7,32.5,30.8,8.8,3.2,10.7,2.7,4.7,8.7h10l.7,5.3c11.2-4.5,18.3-5.9,8.7,5.3,8.6,1.5,9.7,5.5,7.3,10.7l13.7-4,3.1,4c5.2-4.6,10.4-9.2,15.2-13.4l11.2-9.9-8-4,14-10c2.3-9.2,5.6-12.4,10-10V588.4c4.8-3.7,4.1-9,0-15.3l-5-8.3c-2.6,5-4.9-.2-7-15l-7.3-4H309l-3.1,4.7L295,553H285l-1.3-23.3,2-8-4-4,2.5-6.4Z"
                                transform="translate(-190.4 -483.1)" fill="#f2f2f2" stroke="#4d4d4d" strokeMiterlimit="10"
                                strokeWidth="0.5" tabIndex="0" data-toggle="popover" data-trigger="hover"
                                data-popover-content="#Medina_popover" data-placement="top" cx="487" cy="198.5" r="1.9" />
                        </g>
                    </OverlayTrigger>

                    <OverlayTrigger trigger="click" placement={"top"} overlay={
                        <Popover id="popover-basic">
                            <Popover.Title as="h3" className="text-center">مكه المكرمة</Popover.Title>
                            <Popover.Content>
                                <Link to="/" className="btn btn-primary">
                                    الطلبات {data['مكه المكرمة'].requests}
                                </Link>
                                <Link to="/" className="btn btn-success m-1">
                                    العروض المرسلة {data['مكه المكرمة'].offer}
                                </Link>
                            </Popover.Content>
                        </Popover>
                    }>
                        <g id="Makkah" data-name="Component 27 – 14" transform="translate(238.1 598.232)">
                            <path id="Union_31" className="hover" data-name="Union 31"
                                d="M78.817-2157.1l-.017.066c-10.9-20.6-43.6-44.2-58.2-78.2.5-15.4-7.2-35.6-17.6-57.3l19.5,5.9,4.7,8.7h10l.7,5.3c10.1-6.1,11.5-2.8,8.7,5.3,6.3.5,9.7,3.3,7.3,10.7l13.7-4,3.1,4,26.5-23.3-8-4,14-10c2.3-9.2,5.6-12.4,10-10l11.3,33.4c16.8-.3,29.3.8,15.3,10l2.7,4h14.7l-3.3,40,6.3,6.9-7,6.4-17.194,5.893L116.5-2185.232l-3.3-9H96.5c-10.7-10.9-10.4-2.8-8,9l-7.3,6-4,2.7,4.7,7.3-1.6,6.4,6.9,5.7,6.7-2.8,8.5-11.9,8.3,8.2v11l-8.3,3.4H93.9l3,11.3,10.5,3.3v13.4l-7.5,8Z"
                                transform="translate(-3 2304.7)" fill="#e6e6e6" stroke="#4d4d4d" strokeMiterlimit="10"
                                strokeWidth="0.5" tabIndex="0" data-toggle="popover" data-trigger="hover"
                                data-popover-content="#Makkah_popover" data-placement="top" cx="487" cy="198.5" r="1.9" />
                        </g>
                    </OverlayTrigger>
                    <OverlayTrigger trigger="click" placement={"top"} overlay={
                        <Popover id="popover-basic">
                            <Popover.Title as="h3" className="text-center">عسير</Popover.Title>
                            <Popover.Content>
                                <Link to="/" className="btn btn-primary">
                                    الطلبات {data['عسير'].requests}
                                </Link>
                                <Link to="/" className="btn btn-success m-1">
                                    العروض المرسلة {data['عسير'].offer}
                                </Link>
                            </Popover.Content>
                        </Popover>
                    }>
                        <g id="Aseer" data-name="Component 24 – 14" transform="translate(329 693.3)">

                            <path id="Path_391" className="hover" data-name="Path 391"
                                d="M424.3,745.8l-4.7,9.2v13.3c-8.6-3.1-11,1.3-12.7,6.7l-11.7,9.3,3.7,8.7-3.7,8,5,6-5,3.5-8.3-4.8-6.3-7.3-5-8.7-6,8v6.7l-7.3-7.3-10.7-3.3-5.9-4-3.2-8V768.5L332,765l-3-11.3h8.5l8.3-3.3v-11l-8.3-8.3,5.8-8.1,8.4-5.3L367,707l13.7-7.3h7.7l7-6.4,13.7,15.1C406.1,729,412.5,740.2,424.3,745.8Z"
                                transform="translate(-329 -693.3)" fill="#f2f2f2" stroke="#4d4d4d" strokeMiterlimit="10"
                                strokeWidth="0.5" tabIndex="0" data-toggle="popover" data-trigger="hover"
                                data-popover-content="#Aseer_popover" data-placement="top" cx="487" cy="198.5" r="1.9" />
                        </g>
                    </OverlayTrigger>

                    <OverlayTrigger trigger="click" placement={"top"} overlay={
                        <Popover id="popover-basic">
                            <Popover.Title as="h3" className="text-center">الجوف</Popover.Title>
                            <Popover.Content>
                                <Link to="/" className="btn btn-primary">
                                    الطلبات {data['الجوف'].requests}
                                </Link>
                                <Link to="/" className="btn btn-success m-1">
                                    العروض المرسلة {data['الجوف'].offer}
                                </Link>
                            </Popover.Content>
                        </Popover>
                    }>
                        <g id="Al-Jouf" data-name="Component 32 – 14" transform="translate(131.1 337)">
                            <path id="Path_375" className="hover" data-name="Path 375"
                                d="M223.7,337v10.7c3.8,13.3,7.6,17.8,11.3,13.3l28-1.3,20.7,3,6,5H315l8,5.3,10,2.7,6.7,9.3c7,6.2,3.4,10.4-6.7,13.3L310.3,415,309,431l-6.3,2.7L290.3,439l-32.7,16.7h-10L220.3,451V434.3c-2.5-5.5-8.2-1.9-13.3,10-9.6-5.6-19.9-5-30.7,0-3.1-10.6-11.1-15.9-24.7-15.3l-11.3,3.3-9.2.1.5-16.1L169,421l18-24.7,25.3-4c.8-9.2,4.6-14.8,12.7-15.3l-28.7-37.3Z"
                                transform="translate(-131.1 -337)" fill="#f2f2f2" stroke="#4d4d4d" strokeMiterlimit="10"
                                strokeWidth="0.5" tabIndex="0" data-toggle="popover" data-trigger="hover"
                                data-popover-content="#Al-Jouf_popover" data-placement="top" cx="487" cy="198.5" r="1.9" />
                        </g>
                    </OverlayTrigger>

                    <OverlayTrigger trigger="click" placement={"top"} overlay={
                        <Popover id="popover-basic">
                            <Popover.Title as="h3" className="text-center">الحدود الشمالية</Popover.Title>
                            <Popover.Content>
                                <Link to="/" className="btn btn-primary">
                                    الطلبات {data['الحدود الشمالية'].requests}
                                </Link>
                                <Link to="/" className="btn btn-success m-1">
                                    العروض المرسلة {data['الحدود الشمالية'].offer}
                                </Link>
                            </Popover.Content>
                        </Popover>
                    }>
                        <g id="alhudud_alshamalia" data-name="Component 33 – 14" transform="translate(215.7 312.3)">

                            <path id="Path_377" className="hover" data-name="Path 377"
                                d="M331,433.7a35.486,35.486,0,0,1,18.7,2c12.2.3,15.9,3.9,16.7,8.7h11.3l4,5.3h17.4c9.7,4.4,11.1,10.6,10.7,17.3l15.3,4,7.3,8c1.8,5.3,4.4,5.3,8,0v-6.7l14.7-28.7,14.4-14.7-42.4-9.3L286.4,320.3l-21.3-8c-10.4,10.1-26.7,17.6-49.4,22.4l8.1,2.3c-1.6,9.7-.8,18.7,11.3,24l28-1.3,20.7,3,6,5H315a30.706,30.706,0,0,0,18,8l9.5,16-9.5,6.7L310.3,415,309,431l-6.3,2.7,6.3,4Z"
                                transform="translate(-215.7 -312.3)" fill="#ccc" stroke="#4d4d4d" strokeMiterlimit="10"
                                strokeWidth="0.5" tabIndex="0" data-toggle="popover" data-trigger="hover"
                                data-popover-content="#alhudud_alshamalia_popover" data-placement="top" cx="487" cy="198.5"
                                r="1.9" />
                        </g>
                    </OverlayTrigger>

                </g>
            </svg>
        </div>
    );
};

export default MapVector;