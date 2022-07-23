import { Container } from "react-bootstrap";
import { SubtitleWithBadge, Paragraph } from "@Components/Title";
import { FormOnlySelect } from "@Components/Forms";
import { Code } from "@Components/Code";
import { RenderJson } from "@Components/Json";

import { ReturnInformation } from "./Utils";

import { useHandleState } from "@/Hooks";
import { GetLocation } from "@/Utils";

const Put = ({}) => {
  const { show, view, handleChange, handleView } = useHandleState();

  return (
    <>
      <SubtitleWithBadge title="Update resource" className="text-dark" badge="PUT" />
      <Paragraph>
        To can update a resource of course you need a token and you know ID del resource, it already
        be sales, ships and users, the prop need always is ID
      </Paragraph>
      <FormOnlySelect
        data={[
          {
            value: "Embarcaciones",
            text: `${GetLocation()}embarcaciones`,
          },
          {
            value: "Users",
            text: `${GetLocation()}users`,
          },
          {
            value: "Sales",
            text: `${GetLocation()}sales`,
          },
        ]}
        state={show}
        handleChange={handleChange}
        disabled={view === "Body" ? false : true}
      />
      <SubtitleWithBadge title="" className="mt-3" badge="" />
      <FormOnlySelect
        data={[
          {
            value: "Body",
            text: "Body",
          },
          {
            value: "Preview",
            text: "Preview",
          },
        ]}
        state={view}
        handleChange={handleView}
      />
      <Code className={"mt-2"}>
        <Container>
          <RenderJson
            src={
              view === "Body"
                ? ReturnInformation(show)
                : {
                    status: "ok",
                    result: {
                      id: 25,
                      count: 1,
                    },
                  }
            }
            settings={{ name: false }}
          />
        </Container>
      </Code>
    </>
  );
};

export default Put;
