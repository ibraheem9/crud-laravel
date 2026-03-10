appointments_list=(appointments_list && appointments_list !='')? appointments_list:[{}];
main_appointments_list=appointments_list;
console.log("Appointments List", appointments_list);
staff_list=(staff_list && staff_list !='')? staff_list:[{}];
main_staff_list=staff_list;
console.log("Staff List", staff_list);

// function e() {
//     this.$body = l("body"), this.$modal = l("#event-modal"), this.$calendar = l("#kt_calendar_app"), this.$formEvent = l("#form-event"), this.$btnNewEvent = l("#btn-new-event"), this.$btnDeleteEvent = l("#btn-delete-event"), this.$btnSaveEvent = l("#btn-save-event"), this.$modalTitle = l("#modal-title"), this.$calendarObj = null, this.$selectedEvent = null, this.$newEventData = null
// }

"use strict";
var e = null;
var w = null;
var KTAppCalendar = (function () {
    var t,
    n,
    a,
    o,
    r,
    i,
    l,
    d,
    s,
    c,
    m,
    u,
    v,
    f,
    p,
    y,
    D,
    _,
    b,
    k,
    g,
    S,
    Y,
    h,
    T,
    M,
    E,
    L,
    x = {
      id: "",
      eventName: "",
      eventDescription: "",
      eventLocation: "",
      startDate: "",
      endDate: "",
      allDay: !1,
    },
    B = !1;
  const q = (e) => {
      C();
      const n = x.allDay
          ? moment(x.startDate).format("Do MMM, YYYY")
          : moment(x.startDate).format("Do MMM, YYYY - h:mm a"),
        a = x.allDay
          ? moment(x.endDate).format("Do MMM, YYYY")
          : moment(x.endDate).format("Do MMM, YYYY - h:mm a");
      var o = {
        container: "body",
        trigger: "manual",
        boundary: "window",
        placement: "auto",
        dismiss: !0,
        html: !0,
        title: "Event Summary",
        content:
          '<div class="fw-bolder mb-2">' +
          x.eventName +
          '</div><div class="fs-7"><span class="fw-bold">Start:</span> ' +
          n +
          '</div><div class="fs-7 mb-4"><span class="fw-bold">End:</span> ' +
          a +
          '</div>', //<div id="kt_calendar_event_view_button" type="button" class="btn btn-sm btn-light-primary">View More</div>
      };
      (t = KTApp.initBootstrapPopover(e, o)).show(), (B = !0)
    },
    C = () => {
      B && (t.dispose(), (B = !1));
    },
    N = () => {
      (f.innerText = "Add a New Event"), v.show();
      const t = p.querySelectorAll('[data-kt-calendar="datepicker"]'),
        r = p.querySelector("#kt_calendar_datepicker_allday");
    //   r.addEventListener("click", (e) => {
    //     e.target.checked
    //       ? t.forEach((e) => {
    //           e.classList.add("d-none");
    //         })
    //       : (d.setDate(x.startDate, !0, "Y-m-d"),
    //         t.forEach((e) => {
    //           e.classList.remove("d-none");
    //         }));
    //   }),
    //     // O(x),
    //     _.addEventListener("click", function (t) {
    //       t.preventDefault(),
    //         y &&
    //           y.validate().then(function (t) {
    //             console.log("validated!"),
    //               "Valid" == t
    //                 ? (_.setAttribute("data-kt-indicator","on"),
    //                   (_.disabled = !0),
    //                   setTimeout(function () {
    //                     _.removeAttribute("data-kt-indicator"),
    //                       Swal.fire({
    //                         text: "New event added to calendar!",
    //                         icon: "success",
    //                         buttonsStyling: !1,
    //                         confirmButtonText: "Ok, got it!",
    //                         customClass: { confirmButton: "btn btn-primary" },
    //                       }).then(function (t) {
    //                         if (t.isConfirmed) {
    //                           v.hide(), (_.disabled = !1);
    //                           let t = !1;
    //                           r.checked && (t = !0),
    //                             0 === c.selectedDates.length && (t = !0);
    //                           var l = moment(i.selectedDates[0]).format(),
    //                             s = moment(
    //                               d.selectedDates[d.selectedDates.length - 1]
    //                             ).format();
    //                           if (!t) {
    //                             const e = moment(i.selectedDates[0]).format(
    //                                 "YYYY-MM-DD"
    //                               ),
    //                               t = e;
    //                             (l =
    //                               e +
    //                               "T" +
    //                               moment(c.selectedDates[0]).format(
    //                                 "HH:mm:ss"
    //                               )),
    //                               (s =
    //                                 t +
    //                                 "T" +
    //                                 moment(u.selectedDates[0]).format(
    //                                   "HH:mm:ss"
    //                                 ));
    //                           }
    //                           e.addEvent({
    //                             id: V(),
    //                             title: n.value,
    //                             description: a.value,
    //                             location: o.value,
    //                             start: l,
    //                             end: s,
    //                             allDay: t,
    //                           }),
    //                             e.render(),
    //                             p.reset();
    //                         }
    //                       });
    //                   }, 2e3))
    //                 : Swal.fire({
    //                     text: "Sorry, looks like there are some errors detected, please try again.",
    //                     icon: "error",
    //                     buttonsStyling: !1,
    //                     confirmButtonText: "Ok, got it!",
    //                     customClass: { confirmButton: "btn btn-primary" },
    //                   });
    //           });
    //     });
    },
    A = () => {
      var e, t, n;
      w.show(),
        x.allDay
          ? ((e = "All Day"),
            (t = moment(x.startDate).format("Do MMM, YYYY")),
            (n = moment(x.endDate).format("Do MMM, YYYY")))
          : ((e = ""),
            (t = moment(x.startDate).format("Do MMM, YYYY - h:mm a")),
            (n = moment(x.endDate).format("Do MMM, YYYY - h:mm a"))),
        (g.innerText = x.eventName),
        (S.innerText = e),
        (Y.innerText = x.eventDescription ? x.eventDescription : ""),
        (h.innerText = x.eventLocation ? x.eventLocation : ""),
        (T.innerText = t),
        (M.innerText = n);
    },
    // H = () => {
    //   E.addEventListener("click", (t) => {
    //     t.preventDefault(),
    //       w.hide(),
    //       (() => {
    //         (f.innerText = "Edit an Event"), v.show();
    //         const t = p.querySelectorAll('[data-kt-calendar="datepicker"]'),
    //           r = p.querySelector("#kt_calendar_datepicker_allday");
    //         r.addEventListener("click", (e) => {
    //           e.target.checked
    //             ? t.forEach((e) => {
    //                 e.classList.add("d-none");
    //               })
    //             : (d.setDate(x.startDate, !0, "Y-m-d"),
    //               t.forEach((e) => {
    //                 e.classList.remove("d-none");
    //               }));
    //         }),
    //           O(x),
    //           _.addEventListener("click", function (t) {
    //             t.preventDefault(),
    //               y &&
    //                 y.validate().then(function (t) {
    //                   console.log("validated!"),
    //                     "Valid" == t
    //                       ? (_.setAttribute("data-kt-indicator", "on"),
    //                         (_.disabled = !0),
    //                         setTimeout(function () {
    //                           _.removeAttribute("data-kt-indicator"),
    //                             Swal.fire({
    //                               text: "New event added to calendar!",
    //                               icon: "success",
    //                               buttonsStyling: !1,
    //                               confirmButtonText: "Ok, got it!",
    //                               customClass: {
    //                                 confirmButton: "btn btn-primary",
    //                               },
    //                             }).then(function (t) {
    //                               if (t.isConfirmed) {
    //                                 v.hide(),
    //                                   (_.disabled = !1),
    //                                   e.getEventById(x.id).remove();
    //                                 let t = !1;
    //                                 r.checked && (t = !0),
    //                                   0 === c.selectedDates.length && (t = !0);
    //                                 var l = moment(i.selectedDates[0]).format(),
    //                                   s = moment(
    //                                     d.selectedDates[
    //                                       d.selectedDates.length - 1
    //                                     ]
    //                                   ).format();
    //                                 if (!t) {
    //                                   const e = moment(
    //                                       i.selectedDates[0]
    //                                     ).format("YYYY-MM-DD"),
    //                                     t = e;
    //                                   (l =
    //                                     e +
    //                                     "T" +
    //                                     moment(c.selectedDates[0]).format(
    //                                       "HH:mm:ss"
    //                                     )),
    //                                     (s =
    //                                       t +
    //                                       "T" +
    //                                       moment(u.selectedDates[0]).format(
    //                                         "HH:mm:ss"
    //                                       ));
    //                                 }
    //                                 e.addEvent({
    //                                   id: V(),
    //                                   title: n.value,
    //                                   description: a.value,
    //                                   location: o.value,
    //                                   start: l,
    //                                   end: s,
    //                                   allDay: t,
    //                                 }),
    //                                   e.render(),
    //                                   p.reset();
    //                               }
    //                             });
    //                         }, 2e3))
    //                       : Swal.fire({
    //                           text: "Sorry, looks like there are some errors detected, please try again.",
    //                           icon: "error",
    //                           buttonsStyling: !1,
    //                           confirmButtonText: "Ok, got it!",
    //                           customClass: { confirmButton: "btn btn-primary" },
    //                         });
    //                 });
    //           });
    //       })();
    //   });
    // },
    // F = () => {
    //   document
    //     .querySelector("#kt_calendar_event_view_button")
    //     .addEventListener("click", (e) => {
    //       e.preventDefault(), C(), A();
    //     });
    // },
    // O = () => {
    //   (n.value = x.eventName ? x.eventName : ""),
    //     (a.value = x.eventDescription ? x.eventDescription : ""),
    //     (o.value = x.eventLocation ? x.eventLocation : ""),
    //     i.setDate(x.startDate, !0, "Y-m-d");
    //   const e = x.endDate ? x.endDate : moment(x.startDate).format();
    //   d.setDate(e, !0, "Y-m-d");
    //   const t = p.querySelector("#kt_calendar_datepicker_allday"),
    //     r = p.querySelectorAll('[data-kt-calendar="datepicker"]');
    //   x.allDay
    //     ? ((t.checked = !0),
    //       r.forEach((e) => {
    //         e.classList.add("d-none");
    //       }))
    //     : (c.setDate(x.startDate, !0, "Y-m-d H:i"),
    //       u.setDate(x.endDate, !0, "Y-m-d H:i"),
    //       d.setDate(x.startDate, !0, "Y-m-d"),
    //       (t.checked = !1),
    //       r.forEach((e) => {
    //         e.classList.remove("d-none");
    //       }));
    // },
    P = (e) => {
      (x.id = e.id),
        (x.eventName = e.title),
        (x.eventDescription = e.description),
        (x.eventLocation = e.location),
        (x.startDate = e.startStr),
        (x.endDate = e.endStr),
        (x.allDay = e.allDay);
    },
    V = () =>
      Date.now().toString() + Math.floor(1e3 * Math.random()).toString();
  return {
    init: function () {
      const t = document.getElementById("kt_modal_add_event");
      (p = t.querySelector("#kt_modal_add_event_form")),
        (n = p.querySelector('[name="calendar_event_name"]')),
        (a = p.querySelector('[name="calendar_event_description"]')),
        (o = p.querySelector('[name="calendar_event_location"]')),
        (r = p.querySelector("#kt_calendar_datepicker_start_date")),
        (l = p.querySelector("#kt_calendar_datepicker_end_date")),
        (s = p.querySelector("#kt_calendar_datepicker_start_time")),
        (m = p.querySelector("#kt_calendar_datepicker_end_time")),
        // (D = document.querySelector('[data-kt-calendar="add"]')),
        (_ = p.querySelector("#kt_modal_add_event_submit")),
        (b = p.querySelector("#kt_modal_add_event_cancel")),
        (k = t.querySelector("#kt_modal_add_event_close")),
        (f = p.querySelector('[data-kt-calendar="title"]')),
        (v = new bootstrap.Modal(t));
      const B = document.getElementById("kt_modal_view_event");
      var F, O, I, R, G, K;
      (w = new bootstrap.Modal(B)),
        (g = B.querySelector('[data-kt-calendar="event_name"]')),
        (S = B.querySelector('[data-kt-calendar="all_day"]')),
        (Y = B.querySelector('[data-kt-calendar="event_description"]')),
        (h = B.querySelector('[data-kt-calendar="event_location"]')),
        (T = B.querySelector('[data-kt-calendar="event_start_date"]')),
        (M = B.querySelector('[data-kt-calendar="event_end_date"]')),
        (E = B.querySelector("#kt_modal_view_event_edit")),
        (L = B.querySelector("#kt_modal_view_event_delete")),
        (F = document.getElementById("kt_calendar_app")),
        (O = moment().startOf("day")),
        (I = O.format("YYYY-MM")),
        (R = O.clone().subtract(1, "day").format("YYYY-MM-DD")),
        (G = O.format("YYYY-MM-DD")),
        (K = O.clone().add(1, "day").format("YYYY-MM-DD")),
        (e = new FullCalendar.Calendar(F, {
        resourceLabelContent: (info) => {
            if(info.resource.extendedProps.img){
                var img = '<div class="symbol symbol-circle symbol-50px overflow-hidden" style="border: 3px solid #81bcff"><div class="symbol-label"><img src="'+info.resource.extendedProps.img_url+'" alt="" width="50px" height="50px" style="object-fit: cover;border: 3px solid #fff;border-radius: 50%;" /></div></div><p class="fs-6 m-0">'+info.resource.title+'</p><div class="icon" style="width: 18px;margin: auto;"><div class="qUvGHQ kn8Hux m1ZBkJ"><span class="_06c66e3b5 _7cf5c03b5 d59af83b5"><svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><path d="M13.762 6.684l-.48-.458c-.168-.15-.362-.226-.585-.226-.227 0-.42.075-.578.226L9 9.196l-3.12-2.97C5.723 6.076 5.53 6 5.304 6c-.223 0-.417.075-.584.226l-.476.458C4.08 6.84 4 7.024 4 7.24c0 .22.08.404.244.55l4.178 3.978c.154.155.347.232.578.232.227 0 .422-.077.584-.232l4.178-3.978c.16-.15.238-.334.238-.55 0-.21-.08-.397-.238-.556z"></path></svg></span></div></div>';
            } else {
                var Let = info.resource.extendedProps.letter;
                var color = info.resource.extendedProps.color;
                var img = '<div class="symbol symbol-circle symbol-50px overflow-hidden" style="border: 3px solid #81bcff"><div class="symbol-label"><div class="symbol-label fs-3 text-capitalize bg-white text-dark">'+Let+'</div></div></div><p class="fs-6 m-0">'+info.resource.title+'</p><div class="icon" style="width: 18px;margin: auto;"><div class="qUvGHQ kn8Hux m1ZBkJ"><span class="_06c66e3b5 _7cf5c03b5 d59af83b5"><svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><path d="M13.762 6.684l-.48-.458c-.168-.15-.362-.226-.585-.226-.227 0-.42.075-.578.226L9 9.196l-3.12-2.97C5.723 6.076 5.53 6 5.304 6c-.223 0-.417.075-.584.226l-.476.458C4.08 6.84 4 7.024 4 7.24c0 .22.08.404.244.55l4.178 3.978c.154.155.347.232.578.232.227 0 .422-.077.584-.232l4.178-3.978c.16-.15.238-.334.238-.55 0-.21-.08-.397-.238-.556z"></path></svg></span></div></div>';
            }

            var html = '<a href = "javascript:void(0);" staff_name = "'+info.resource.title+'" staff_id = "'+info.resource.id+'" data-bs-toggle= "modal" data-bs-target ="#trainer_template_time_modal" class="trainer_template_time"  style="color: var(--bs-body-color) !important;display:block;padding: 0.75rem 0.5rem;">'+ img +'</a >';
            return { html: html }
        },
        initialView: 'resourceTimeGridDay',
          headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "staffButton,venueButton,timeGridWeek,dayGridMonth",
          },
          height: 'auto',
          slotDuration: "00:15:00",
          customButtons: {
            staffButton: {
                text: 'Staff',
                click: () => KTAppCalendar.staffCalender()
            },
            venueButton: {
                text: 'Venue',
                click: () => KTAppCalendar.venueCalender()
            }
        },
        //   schedulerLicenseKey: "0256010375-fcs-1685962253",
        initialDate: G,
        navLinks: !0,
        selectable: !0,
        selectMirror: !0,
        select: function (e) {
            C(), P(e), N();
        },
        dateClick: function (info) {
            console.log(info.resource.id);
            $("#kt_modal_add_event").find('#staff_id').val('');
            $("#kt_modal_add_event").find('#staff_id').val(info.resource.id);
            var date = new Date(info.dateStr);
            //dd/mm/yyyy
            var hours= String(date.getHours()).padStart(2, '0');
            var minutes= String(date.getMinutes()).padStart(2, '0');
            var seconds= String(date.getSeconds()).padStart(2, '0');
            var month= String(date.getMonth()+1).padStart(2, '0')
            var day= String(date.getDate()).padStart(2, '0')

            $("#kt_modal_add_event").find('#start_time').val(hours+':' +minutes+':'+seconds);
            $("#kt_modal_add_event").find('.reservations_date').val(date.getFullYear()+ '-' + month + '-' +day);
        },
        eventClick: function (e) {
            // console.log(e.event.extendedProps.service_type);
            // console.log(e.event.extendedProps.reserve_id);
            if(e.event.extendedProps.service_type == 'pre_booking'){
                // console.log(e.event.extendedProps);
                $('#kt_modal_view_event_edit').attr('type','pre');
                $('#kt_modal_view_event_delete').attr('reserve_id',e.event.extendedProps.reserve_id);
                $('#kt_modal_view_event_delete').css('display','inherit');
                set_data_pre_app(e.event.extendedProps.service_type,e.event.id,e.event.extendedProps.group_id,e.event.extendedProps.customer_id);

                C(),
                P({
                    id: e.event.id,
                    title: e.event.title,
                    description: e.event.extendedProps.description,
                    location: e.event.extendedProps.location,
                    startStr: e.event.startStr,
                    endStr: e.event.endStr,
                    allDay: e.event.allDay,
                }),
                A();
            } else if(e.event.extendedProps.service_type == 'break') {
                // console.log(e.event);
                $('#kt_modal_view_event_edit').attr('type','');
                $("#cancel_unavailable_time_modal").modal("show");
                $(".add_break_time_cancel_div").find("#unavailable_hours_id").val(e.event.extendedProps.unavailable_hours_id);
                $(".add_break_time_cancel_div").find("#break_event_id").val(e.event.id);
            } else {
                $('#kt_modal_view_event_edit').attr('type','');
                $('#kt_modal_view_event_delete').css('display','none');
                set_data_appointments(e.event.extendedProps.service_type,e.event.extendedProps.reserve_id,e.event.extendedProps.group_id,e.event.title,e.event.extendedProps.invoice_id,e.event.extendedProps.fee,e.event.extendedProps.event_start_time,e.event.extendedProps.event_end_time,e.event.extendedProps.reservations_date,e.event.extendedProps.is_checked_in,e.event.extendedProps.is_checked_out)

                C(),
                P({
                    id: e.event.id,
                    title: e.event.title,
                    description: e.event.extendedProps.description,
                    location: e.event.extendedProps.location,
                    startStr: e.event.startStr,
                    endStr: e.event.endStr,
                    allDay: e.event.allDay,
                }),
                A();
            }
        },
        eventMouseEnter: function (e) {
        P({
            id: e.event.id,
            title: e.event.title,
            description: e.event.extendedProps.description,
            location: e.event.extendedProps.location,
            startStr: e.event.startStr,
            endStr: e.event.endStr,
            allDay: e.event.allDay,
        });
        // remove popover for break hours
        // console.log(e.event.extendedProps.service_type);
        if(e.event.extendedProps.service_type == 'break'){
            $('.popover').hide();
        } else {
            q(e.el);
        }
        },
        editable: !0,
        dayMaxEvents: !0,
        resources: staff_list,
        events: appointments_list,
        datesSet: function (info) {
            let calenderType=info.view.type;
            let startDate=info.start;
            let start=moment(startDate.toISOString()).format('YYYY-MM-DD');
            let endDate=info.end;
            let end=moment(endDate.toISOString()).format('YYYY-MM-DD');
            // you code here
            var staff_id = ($('#select_staff option:selected').val() && $('#select_staff option:selected').val() !='')? $('#select_staff option:selected').val():'all';
            refresh_trainer_events(staff_id,calenderType,start,end);
            var all_events = e.getEvents();
            $.each(all_events, function (key, value) {
                set_status_payment(value._def.extendedProps.service_type,value._def.extendedProps.payment_way,value['id']);
            });
            C();
        },
        eventDrop: function(info) {
            $('.popover').hide();
            $('#confirm-drag-event-modal').modal('show');
            $(document).on('click', '.close_drop_btn', function(){
                info.revert();
            });
            $(document).on('click', '#confirm-drag-event-modal .btn-close', function(){
                info.revert();
            });

            $(document).on('click', '.do_drop_event', function(){
                var startDrop=info.event._instance.range.start.toISOString();
                var endDrop=info.event._instance.range.end.toISOString();
                var reservation_date=moment.utc(startDrop).format("YYYY-MM-DD");
                var start_time = moment.utc(startDrop).format("HH:mm:ss");
                var end_time = moment.utc(endDrop).format("HH:mm:ss");
                var id =info.event.id;
                id = (info.event._def.extendedProps['service_type'] == 'break')?info.event._def.extendedProps['unavailable_hours_id']:id;
                const staff_id =info.event._def.resourceIds[0];
                $.ajax({
                    type: 'POST',
                    url: ''+baseUrl+'/services/appointments/update_appointment_time',
                    data: {reserve_id:id,start_time:start_time,end_time:end_time,reservation_date:reservation_date,staff_id:staff_id,service_type:info.event._def.extendedProps['service_type']},
                    cache: "false",
                    btn: $('.do_drop_event'),
                    success: function(data) {
                        var status=data.data;
                        if(status)
                        {
                            toastr.success(data.msg);
                            set_status_payment(info.event._def.extendedProps.service_type,info.event._def.extendedProps.payment_way,id);
                            $('#confirm-drag-event-modal').modal('hide');
                        }else
                        {
                            toastr.error(data.msg);
                            $('#confirm-drag-event-modal').modal('hide');
                            info.revert();
                        }

                    }
                });
                return false;
            });
        },
        })).render(),
        // (y = FormValidation.formValidation(p, {
        //   fields: {
        //     calendar_event_name: {
        //       validators: { notEmpty: { message: "Event name is required" } },
        //     },
        //     calendar_event_start_date: {
        //       validators: { notEmpty: { message: "Start date is required" } },
        //     },
        //     calendar_event_end_date: {
        //       validators: { notEmpty: { message: "End date is required" } },
        //     },
        //   },
        //   plugins: {
        //     trigger: new FormValidation.plugins.Trigger(),
        //     bootstrap: new FormValidation.plugins.Bootstrap5({
        //       rowSelector: ".fv-row",
        //       eleInvalidClass: "",
        //       eleValidClass: "",
        //     }),
        //   },
        // })),
        // (i = flatpickr(r, { enableTime: !1, dateFormat: "Y-m-d" })),
        // (d = flatpickr(l, { enableTime: !1, dateFormat: "Y-m-d" })),
        // (c = flatpickr(s, {
        //   enableTime: !0,
        //   noCalendar: !0,
        //   dateFormat: "H:i",
        // })),
        // (u = flatpickr(m, {
        //   enableTime: !0,
        //   noCalendar: !0,
        //   dateFormat: "H:i",
        // })),
        // H(),
        // D.addEventListener("click", (e) => {
        //   C(),
        //     (x = {
        //       id: "",
        //       eventName: "",
        //       eventDescription: "",
        //       startDate: new Date(),
        //       endDate: new Date(),
        //       allDay: !1,
        //     }),
        //     N();
        // }),
        L.addEventListener("click", (t) => {
            t.preventDefault(),
              Swal.fire({
                text: "Are you sure you would like to delete this event?",
                icon: "warning",
                showCancelButton: !0,
                buttonsStyling: !1,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, return",
                customClass: {
                  confirmButton: "btn btn-primary delete_pre_booking",
                  cancelButton: "btn btn-active-light",
                },
              }).then(function (t) {
                if (t.value) {
                  // User confirmed deletion
                  $.ajax({
                    type: "DELETE",
                    url: ''+baseUrl+'/services/appointments/cancel_prebooking',
                    data: { event_id: x.id }, // Pass any data you need to identify the event
                    success: function (response) {
                        // console.log('ahmed224');
                      e.getEventById(x.id).remove(); // Remove the event from FullCalendar
                      console.log(e.getEventById(x.id).remove());
                      w.hide();
                    },
                    error: function (xhr, status, error) {
                      // Handle errors
                      Swal.fire({
                        text: "Error deleting the event.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: { confirmButton: "btn btn-primary" },
                      });
                    },
                  });
                } else if (t.dismiss === "cancel") {
                  // User canceled deletion
                  Swal.fire({
                    text: "Your event was not deleted!.",
                    icon: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "Ok, got it!",
                    customClass: { confirmButton: "btn btn-primary" },
                  });
                }
              });
          }),
        b.addEventListener("click", function (e) {
          e.preventDefault(),
            Swal.fire({
              text: "Are you sure you would like to cancel?",
              icon: "warning",
              showCancelButton: !0,
              buttonsStyling: !1,
              confirmButtonText: "Yes, cancel it!",
              cancelButtonText: "No, return",
              customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-active-light",
              },
            }).then(function (e) {
              e.value
                ? (p.reset(), v.hide())
                : "cancel" === e.dismiss &&
                  Swal.fire({
                    text: "Your form has not been cancelled!.",
                    icon: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "Ok, got it!",
                    customClass: { confirmButton: "btn btn-primary" },
                  });
            });
        }),
        k.addEventListener("click", function (e) {
          e.preventDefault(),
            Swal.fire({
              text: "Are you sure you would like to cancel?",
              icon: "warning",
              showCancelButton: !0,
              buttonsStyling: !1,
              confirmButtonText: "Yes, cancel it!",
              cancelButtonText: "No, return",
              customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-active-light",
              },
            }).then(function (e) {
              e.value
                ? (p.reset(), v.hide())
                : "cancel" === e.dismiss &&
                  Swal.fire({
                    text: "Your form has not been cancelled!.",
                    icon: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "Ok, got it!",
                    customClass: { confirmButton: "btn btn-primary" },
                  });
            });
        }),
        ((e) => {
        //   e.addEventListener("hidden.bs.modal", (e) => {
        //     y && y.resetForm(!0);
        //   });
        })(t);
    },
    staffCalender : function (individual_staff_list =null) {
        $('.trainers_list_div').css('display','inherit');
        staff_list=(individual_staff_list && individual_staff_list !=null && individual_staff_list !=-1)? individual_staff_list :main_staff_list;
        // console.log(individual_staff_list);
        // console.log(appointments_list);

        var staff_id = $('#select_staff').val();
        var selected_staff_gender = $('#select_staff option:selected').attr('gender');

        var gender = $('#select_gender').val();
        // console.log(staff_id);
        if(individual_staff_list ==null || individual_staff_list == -1 || staff_id == '')
        {
            appointments_list=main_appointments_list;
        }

        if(staff_id || gender ||  (individual_staff_list && individual_staff_list !=null && individual_staff_list !=-1))
        {
            // get Staff info
            // Refresh Staffs list
            var selected_trainer_appointment=[];
            if(staff_id && (gender =='F' || gender =='M')) {
                $.each(main_appointments_list, function (key, value) {
                    if (value['resourceId'] == staff_id && value['gender'] == gender) {
                        selected_trainer_appointment.push(value);
                    }
                });
            }else if(staff_id)
            {
                $.each(main_appointments_list, function (key, value) {
                    if (value['resourceId'] == staff_id) {
                        selected_trainer_appointment.push(value);
                    }
                });
            }else if((gender =='F' || gender =='M'))
            {
                $.each(main_appointments_list, function (key, value) {
                    if (value['gender'] == gender) {
                        selected_trainer_appointment.push(value);
                    }
                });
            }
            if(staff_id || (gender =='F' || gender =='M'))
            {
                appointments_list=selected_trainer_appointment;
            }
            // Refresh Appointments list
            if(staff_id && (gender =='all' || gender == selected_staff_gender)) {
                var staff = [];
                var result = main_staff_list.find(obj => {
                    if (obj.id == staff_id) {
                        return obj;
                    }
                });
                staff.push(result);
                staff_list = staff;
            }else
            {
                if(staff_id && gender != selected_staff_gender)
                {
                    staff_list=[{}];
                }
            }

        }

        if(staff_id == '' && (gender =='F' || gender =='M'))
        {
            staff_list=staff_gender_list;
        }

        calender.destroy();


        var O = moment().startOf("day");
        var G = O.format("YYYY-MM-DD");
        var calendarEl = document.getElementById('kt_calendar_app');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            resourceLabelContent: (info) => {
                if(info.resource.extendedProps.img){
                    var img = '<div class="symbol symbol-circle symbol-50px overflow-hidden" style="border: 3px solid #81bcff"><div class="symbol-label"><img src="'+info.resource.extendedProps.img_url+'" alt="" width="50px" height="50px" style="object-fit: cover;border: 3px solid #fff;border-radius: 50%;" /></div></div><p class="fs-6 m-0">'+info.resource.title+'</p><div class="icon" style="width: 18px;margin: auto;"><div class="qUvGHQ kn8Hux m1ZBkJ"><span class="_06c66e3b5 _7cf5c03b5 d59af83b5"><svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><path d="M13.762 6.684l-.48-.458c-.168-.15-.362-.226-.585-.226-.227 0-.42.075-.578.226L9 9.196l-3.12-2.97C5.723 6.076 5.53 6 5.304 6c-.223 0-.417.075-.584.226l-.476.458C4.08 6.84 4 7.024 4 7.24c0 .22.08.404.244.55l4.178 3.978c.154.155.347.232.578.232.227 0 .422-.077.584-.232l4.178-3.978c.16-.15.238-.334.238-.55 0-.21-.08-.397-.238-.556z"></path></svg></span></div></div>';
                } else {
                    var Let = info.resource.extendedProps.letter;
                    var color = info.resource.extendedProps.color;
                    var img = '<div class="symbol symbol-circle symbol-50px overflow-hidden" style="border: 3px solid #81bcff"><div class="symbol-label"><div class="symbol-label fs-3 text-capitalize bg-white text-dark">'+Let+'</div></div></div><p class="fs-6 m-0">'+info.resource.title+'</p><div class="icon" style="width: 18px;margin: auto;"><div class="qUvGHQ kn8Hux m1ZBkJ"><span class="_06c66e3b5 _7cf5c03b5 d59af83b5"><svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><path d="M13.762 6.684l-.48-.458c-.168-.15-.362-.226-.585-.226-.227 0-.42.075-.578.226L9 9.196l-3.12-2.97C5.723 6.076 5.53 6 5.304 6c-.223 0-.417.075-.584.226l-.476.458C4.08 6.84 4 7.024 4 7.24c0 .22.08.404.244.55l4.178 3.978c.154.155.347.232.578.232.227 0 .422-.077.584-.232l4.178-3.978c.16-.15.238-.334.238-.55 0-.21-.08-.397-.238-.556z"></path></svg></span></div></div>';
                }
    
                var html = '<a href = "javascript:void(0);" staff_name = "'+info.resource.title+'" staff_id = "'+info.resource.id+'" data-bs-toggle= "modal" data-bs-target ="#trainer_template_time_modal" class="trainer_template_time"  style="color: var(--bs-body-color) !important;display:block;padding: 0.75rem 0.5rem;">'+ img +'</a >';
                return { html: html }
            },
            initialView: 'resourceTimeGridDay',
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "staffButton,venueButton,timeGridWeek,dayGridMonth",
            },
            customButtons: {
                staffButton: {
                    text: 'Staff',
                    click: () => KTAppCalendar.staffCalender()
                },
                venueButton: {
                    text: 'Venue',
                    click: () => KTAppCalendar.venueCalender()
                }
            },
            height: 'auto',
            slotDuration: "00:15:00",
            //   schedulerLicenseKey: "0256010375-fcs-1685962253",
            initialDate: G,
            navLinks: !0,
            selectable: !0,
            selectMirror: !0,
            select: function (e) {
                C(), P(e), N();
            },
            dateClick: function (info) {
                // console.log(info.resource.id);
                $("#kt_modal_add_event").find('#staff_id').val('');
                $("#kt_modal_add_event").find('#staff_id').val(info.resource.id);
                var date = new Date(info.dateStr);
                //dd/mm/yyyy
                var hours= String(date.getHours()).padStart(2, '0');
                var minutes= String(date.getMinutes()).padStart(2, '0');
                var seconds= String(date.getSeconds()).padStart(2, '0');
                var month= String(date.getMonth()+1).padStart(2, '0')
                var day= String(date.getDate()).padStart(2, '0')

                $("#kt_modal_add_event").find('#start_time').val(hours+':' +minutes+':'+seconds);
                $("#kt_modal_add_event").find('.reservations_date').val(date.getFullYear()+ '-' + month + '-' +day);
            },
            eventClick: function (e) {
                if(e.event.extendedProps.service_type == 'pre_booking'){
                    // console.log(e.event.extendedProps);
                    $('#kt_modal_view_event_edit').attr('type','pre');
                    $('#kt_modal_view_event_delete').attr('reserve_id',e.event.extendedProps.reserve_id);
                    $('#kt_modal_view_event_delete').css('display','inherit');
                    set_data_pre_app(e.event.extendedProps.service_type,e.event.id,e.event.extendedProps.group_id,e.event.extendedProps.customer_id);

                    C(),
                    P({
                        id: e.event.id,
                        title: e.event.title,
                        description: e.event.extendedProps.description,
                        location: e.event.extendedProps.location,
                        startStr: e.event.startStr,
                        endStr: e.event.endStr,
                        allDay: e.event.allDay,
                    }),
                    A();
                } else if(e.event.extendedProps.service_type == 'break') {
                    // console.log(e.event);
                    $('#kt_modal_view_event_edit').attr('type','');
                    $("#cancel_unavailable_time_modal").modal("show");
                    $(".add_break_time_cancel_div").find("#unavailable_hours_id").val(e.event.extendedProps.unavailable_hours_id);
                    $(".add_break_time_cancel_div").find("#break_event_id").val(e.event.id);
                } else {
                    $('#kt_modal_view_event_edit').attr('type','');
                    $('#kt_modal_view_event_delete').css('display','none');
                    set_data_appointments(e.event.extendedProps.service_type,e.event.extendedProps.reserve_id,e.event.extendedProps.group_id,e.event.title,e.event.extendedProps.invoice_id,e.event.extendedProps.fee,e.event.extendedProps.event_start_time,e.event.extendedProps.event_end_time,e.event.extendedProps.reservations_date,e.event.extendedProps.is_checked_in,e.event.extendedProps.is_checked_out)

                    C(),
                    P({
                        id: e.event.id,
                        title: e.event.title,
                        description: e.event.extendedProps.description,
                        location: e.event.extendedProps.location,
                        startStr: e.event.startStr,
                        endStr: e.event.endStr,
                        allDay: e.event.allDay,
                    }),
                    A();
                }
            },
            eventMouseEnter: function (e) {
                P({
                id: e.event.id,
                title: e.event.title,
                description: e.event.extendedProps.description,
                location: e.event.extendedProps.location,
                startStr: e.event.startStr,
                endStr: e.event.endStr,
                allDay: e.event.allDay,
                }),
                q(e.el);
            },
            editable: !0,
            dayMaxEvents: !0,
            resources: staff_list,
            events: appointments_list,
            datesSet: function (info) {
                let calenderType=info.view.type;
                let startDate=info.start;
                let start=moment(startDate.toISOString()).format('YYYY-MM-DD');
                let endDate=info.end;
                let end=moment(endDate.toISOString()).format('YYYY-MM-DD');
                // you code here
                var staff_id = ($('#select_staff option:selected').val() && $('#select_staff option:selected').val() !='')? $('#select_staff option:selected').val():'all';
                refresh_trainer_events(staff_id,calenderType,start,end);
                var all_events = e.getEvents();
                $.each(all_events, function (key, value) {
                    set_status_payment(value._def.extendedProps.service_type,value._def.extendedProps.payment_way,value['id']);
                });
                C();
            },
            eventDrop: function(info) {
                $('.popover').hide();
                $('#confirm-drag-event-modal').modal('show');
                $(document).on('click', '.close_drop_btn', function(){
                    info.revert();
                });
                $(document).on('click', '#confirm-drag-event-modal .btn-close', function(){
                    info.revert();
                });

                $(document).on('click', '.do_drop_event', function(){
                    var startDrop=info.event._instance.range.start.toISOString();
                    var endDrop=info.event._instance.range.end.toISOString();
                    var reservation_date=moment.utc(startDrop).format("YYYY-MM-DD");
                    var start_time = moment.utc(startDrop).format("HH:mm:ss");
                    var end_time = moment.utc(endDrop).format("HH:mm:ss");
                    var id =info.event.id;
                    id = (info.event._def.extendedProps['service_type'] == 'break')?info.event._def.extendedProps['unavailable_hours_id']:id;
                    const staff_id =info.event._def.resourceIds[0];
                    $.ajax({
                        type: 'POST',
                        url: ''+baseUrl+'/services/appointments/update_appointment_time',
                        data: {reserve_id:id,start_time:start_time,end_time:end_time,reservation_date:reservation_date,staff_id:staff_id,service_type:info.event._def.extendedProps['service_type']},
                        cache: "false",
                        btn: $('.do_drop_event'),
                        success: function(data) {
                            var status=data.data;
                            if(status)
                            {
                                toastr.success(data.msg);
                                set_status_payment(info.event._def.extendedProps.service_type,info.event._def.extendedProps.payment_way,id);
                                $('#confirm-drag-event-modal').modal('hide');
                            }else
                            {
                                toastr.error(data.msg);
                                $('#confirm-drag-event-modal').modal('hide');
                                info.revert();
                            }

                        }
                    });
                    return false;
                });
            },
            }).render()

            var date = calender.getDate();
            current_calender_date=moment(date.toISOString()).format('YYYY-MM-DD');
            set_color('staffButton','venueButton');
    },
    venueCalender() {
        $('.trainers_list_div').css('display','none');
        calender.destroy();
        var O = moment().startOf("day");
        var G = O.format("YYYY-MM-DD");
        var calendarEl = document.getElementById('kt_calendar_app');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'resourceTimeGridDay',
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "staffButton,venueButton,timeGridWeek,dayGridMonth",
            },
            customButtons: {
                staffButton: {
                    text: 'Staff',
                    click: () => KTAppCalendar.staffCalender()
                },
                venueButton: {
                    text: 'Venue',
                    click: () => KTAppCalendar.venueCalender()
                }
            },
            height: 'auto',
            slotDuration: "00:15:00",
            //   schedulerLicenseKey: "0256010375-fcs-1685962253",
            initialDate: G,
            navLinks: !0,
            selectable: !0,
            selectMirror: !0,
            select: function (e) {
                C(), P(e), N();
            },
            eventClick: function (e) {
                C(),
                P({
                    id: e.event.id,
                    title: e.event.title,
                    description: e.event.extendedProps.description,
                    location: e.event.extendedProps.location,
                    startStr: e.event.startStr,
                    endStr: e.event.endStr,
                    allDay: e.event.allDay,
                }),
                A();
            },
            eventMouseEnter: function (e) {
                P({
                id: e.event.id,
                title: e.event.title,
                description: e.event.extendedProps.description,
                location: e.event.extendedProps.location,
                startStr: e.event.startStr,
                endStr: e.event.endStr,
                allDay: e.event.allDay,
                }),
                q(e.el);
            },
            editable: !0,
            dayMaxEvents: !0,
            resources: [
                { id: 'a', title: 'Venue A' },
                { id: 'b', title: 'Venue B'},
                { id: 'c', title: 'Venue C' },
                { id: 'd', title: 'Venue D' }
            ],
            // events: 'https://fullcalendar.io/api/demo-feeds/events.json?with-resources=3&single-day',
            "events": [
                {
                    "id": V(),
                    "title": "Event 1",
                    "start": "2023-09-07T01:00:00",
                    "end": "2023-09-07T03:00:00",
                    "description": "Lorem ipsum dolor incid idunt ut labore",
                    "className": "fc-event-primary",
                    "location": "Meeting Room 7.03",
                    "resourceId": "a"
                },
                {
                    "id": V(),
                    "title": "Event 2",
                    "start": "2023-09-07T03:00:00",
                    "end": "2023-09-07T05:00:00",
                    "description": "Lorem ipsum dolor incid idunt ut labore",
                    "className": "fc-event-success",
                    "location": "Meeting Room 7.03",
                    "resourceId": "b"
                },
                {
                    "id": V(),
                    "title": "Event 3",
                    "start": "2023-09-07T05:00:00",
                    "end": "2023-09-07T07:00:00",
                    "description": "Lorem ipsum dolor incid idunt ut labore",
                    "className": "fc-event-warning text-warning-custom",
                    "location": "Meeting Room 7.03",
                    "resourceId": "c"
                },
                {
                    "id": V(),
                    "title": "Event 4",
                    "start": "2023-09-07T07:00:00",
                    "end": "2023-09-07T09:00:00",
                    "description": "Lorem ipsum dolor incid idunt ut labore",
                    "className": "fc-event-danger",
                    "location": "Meeting Room 7.03",
                    "resourceId": "d"
                }
            ],
            datesSet: function () {
                C();
            },
            }).render();

        $('.fc-v-event').find('.create_ribbon').hide();
        $('.fc-v-event').find('.create_icon').hide();
        $('.fc-v-event').find('.create_text_status').hide();
        set_color('venueButton','staffButton');
    }
  };

})();
// KTUtil.onDOMContentLoaded(function () {
//     KTAppCalendar.init();
// });

