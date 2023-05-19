<?php
// ====A+P+P+K+E+Y====
    // const IS_PENDING = 0;
    // const IS_DRIVER_ACCEPT = 1; //DRIVER
    // const IS_DEPARTURE = 2; //DRIVER
    // const IS_DEPARTURE_CONFIRMATION = 3; //USER
    // const IS_ARRIVAL = 4; //DRIVER
    // const IS_COMPLETE = 5; //USER
    // const IS_CANCEL = 6; //DRIVER & USER

    const IS_PENDING = 0;
    const IS_DRIVER_ACCEPT = 1; //DRIVER
    const IS_DEPARTURE_TO_CUSTOMER = 2; //DRIVER
    const IS_ARRIVAL_AT_CUSTOMER = 3; //DRIVER
    const IS_CUSTOMER_CONFIRMATION = 4; //USER
    const IS_DEPARTURE_TO_DESTINATION = 5; //DRIVER
    const IS_ARRIVAL_AT_DESTINATION = 6; //DRIVER
    const IS_COMPLETE = 7; //USER
    const IS_CANCEL = 8; //DRIVER & USER
    const IS_DRIVER_CONFIRMATION = 9; //DRIVER

    // driver status
    const DRIVER_INACTIVE = 0;
    const DRIVER_ACTIVE = 1;

    // customer status
    const CUSTOMER_INACTIVE = 0;
    const CUSTOMER_ACTIVE = 1;
