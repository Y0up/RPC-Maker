import axios from 'axios';
import { SUBMIT_STEP, setErrorStep, changeStepState, SUBMIT_SURVEY } from 'src/actions/devis';
import { setUser } from 'src/actions/user';

export default (store) => (next) => (action) => {
  switch (action.type) {
    case SUBMIT_STEP: {
      const state = store.getState();
      axios.post('http://54.173.92.69/api/user/validation', { ...state.devis.dataSurvey })
        .then((response) => {
          console.log(response);
          store.dispatch(changeStepState(action.step));
        })
        .catch((error) => {
          console.log(error.response);
          store.dispatch(setErrorStep(error.response.data));
        });
      break;
    }
    case SUBMIT_SURVEY: {
      const state = store.getState();
      axios.post('http://54.173.92.69/api/user', { ...state.devis.dataSurvey })
        .then((response) => {
          console.log(response);
          //const idBuilder = response.data.builder.id;
          //localStorage.setItem('slug', response.data.slug);
          //store.dispatch(setUser(response.data.username, response.data.roles[0], response.data.commands, idBuilder, response.data.id, response.data.level, response.data.firstname, response.data.lastname));
          store.dispatch(changeStepState(9));
        })
        .catch((error) => {
          console.log(error.response);
          store.dispatch(setErrorStep(error.response.data));
        });
      break;
    }
    default:
      next(action);
      break;
  }
};
