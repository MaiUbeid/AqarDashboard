import { getMeanSideBar, getMeanSideBarUser } from './services/MeanSideBar'

const getNavArray = async () => {
    const requestBar = await getMeanSideBar();
    return await requestBar.data.data;
}

const getMeanSideBarArray = async () => {
    const providersBar = await getMeanSideBarUser();
    return await providersBar.data.data
}

export default { getNavArray, getMeanSideBarArray };