import Mock from "../mock";
import shortid from "shortid";
const date = new Date();

const calendarEventDB = {
  events: [
    {
      id: "344jdfher3wh23",
      title: "Meeting with all employees",
      start: new Date(date.getFullYear(), date.getMonth(), 1),
      end: new Date(date.getFullYear(), date.getMonth(), 3),
      classNames: ["text-white"],
      allDay: true
    },
    {
      id: "344jdfher3wh245",
      title: "A trip to Bali Island",
      start: new Date(),
      end: new Date(date.getFullYear(), date.getMonth(), date.getDate() + 2),
      classNames: ["text-white"],
      allDay: true
    }
  ]
};

Mock.onGet("/api/calendar/events/all").reply(config => {
  return [200, calendarEventDB.events];
});

Mock.onPost("/api/calendar/events/add").reply(config => {
  let { start, end, ...others } = JSON.parse(config.data);
  let event = {
    id: shortid.generate(),
    start: new Date(start),
    end: new Date(end),
    ...others
  };
  calendarEventDB.events.push(event);
  return [200, calendarEventDB.events];
});

Mock.onPost("/api/calendar/events/update").reply(config => {
  let updatedEvent = JSON.parse(config.data);
  calendarEventDB.events = calendarEventDB.events.map(event => {
    if (event.id === updatedEvent.id) {
      return { ...updatedEvent };
    }
    return event;
  });

  return [200, calendarEventDB.events];
});

Mock.onPost("/api/calendar/events/delete").reply(config => {
  let event = JSON.parse(config.data);

  calendarEventDB.events.map((element, i) => {
    if (element.id === event.id) {
      return [200, calendarEventDB.events.splice(i, 1)];
    }
  });

  return [200, calendarEventDB.events];
});
