import axios from 'axios';
import { SUBMIT_STEP, setErrorStep, changeStepState } from 'src/actions/devis';

export default (store) => (next) => (action) => {
  switch (action.type) {
    case SUBMIT_STEP: {
      console.log(action.step);
      console.log('middleware devis');
      const state = store.getState();
      axios.post('http://localhost:3000/user/validation', { ...state.devis.dataSurvey })
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
    default:
      next(action);
      break;
  }
};