import { DESACTIVATE_LOADER, ACTIVATE_LOAD, CHANGE_FIELD, LOGIN, FAIL_LOGIN, SET_USER, IS_LOGGED, UNSET_USER, IS_LOADING, SET_MESSAGES, CHANGE_NEW_MESSAGE, CLEAN_NEW_MESSAGE } from '../actions/user';

export const initialState = {
  id: '',
  email: '',
  password: '',
  error: '',
  isLogged: false,
  username: 'Mon compte',
  isLoading: false,
  role: '',
  commands: [],
  builderId: 0,
  messages: [],
  newMessage: '',
  level: 0,
  image: '',
  email: '',
};

const user = (state = initialState, action = {}) => {
  switch (action.type) {
    case CHANGE_FIELD:
      return {
        ...state,
        [action.name]: action.value,
      };
    case FAIL_LOGIN:
      return {
        ...state,
        error: action.error.data.message,
        isLoading: false,
      };
    case SET_USER:
      return {
        ...state,
        username: action.username,
        isLogged: true,
        isLoading: false,
        role: action.role,
        commands: action.commands,
        builderId: action.builderId,
        id: action.id,
        level: action.level,
        firstname: action.firstname,
        lastname: action.lastname,
        image: action.image,
        email: action.email,
      };
    case LOGIN:
      return {
        ...state,
        info: {},
      };
    case IS_LOGGED:
      return {
        ...state,
      };
    case UNSET_USER:
      localStorage.clear();
      return {
        ...state,
        username: 'Mon compte',
        role: '',
        isLogged: false,
      };
    case IS_LOADING:
      return {
        ...state,
        isLoading: true,
      };
    case ACTIVATE_LOAD:
      return {
        ...state,
        isLoading: true,
      };
    case SET_MESSAGES:
      return {
        ...state,
        messages: action.messages,
      };
    case CHANGE_NEW_MESSAGE:
      return {
        ...state,
        newMessage: action.value,
      };
    case CLEAN_NEW_MESSAGE:
      return {
        ...state,
        newMessage: '',
      };
    case DESACTIVATE_LOADER:
      return {
        ...state,
        idLoading: false,
      };
    default:
      return state;
  }
};

export default user;
