import { api } from "./api";

export const ModuleModel = {
    getAllModule(){
        return api.get('/modules');
    },
    activateModule(id){
        return api.post(`/modules/${id}/activate`)
    },
    deactivateModule(id){
        return api.post(`/modules/${id}/deactivate`)
    }
}